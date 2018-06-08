<?php

/**
 * redis 操作
 */

class CacheRedis extends Cache{

	private $prefix;
    private static $config;
    private static $_rd = null;

    public function __construct() {

        if (!extension_loaded('redis')) {
            throw_exception('redis failed to load');
        }

    	self::$config = C('redis');

    }

    private function init_master(){
    	static $_cache;
    	if (isset($_cache)){
    		$this->handler = $_cache;
    	} else {
	        $func = self::$config['pconnect'] ? 'pconnect' : 'connect';
	        $this->handler  = new Redis;
	        $this->enable = $this->handler->$func(self::$config['master']['host'], self::$config['master']['port']);
	        $_cache = $this->handler;
            //$_cache->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    	}
    }

    private function init_slave(){
    	static $_cache;
    	if (isset($_cache)){
    		$this->handler = $_cache;
    	}else{
	        $func = self::$config['pconnect'] ? 'pconnect' : 'connect';
	        $this->handler = new Redis;
	        $this->enable = $this->handler->$func(self::$config['slave']['host'], self::$config['slave']['port']);
	        $_cache = $this->handler;
            //$_cache->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    	}
    }

    private static function init() {

        if (self::$_rd) {
            return self::$_rd;
        }
        self::$_rd = new \Redis();
        //try{

        self::$_rd->connect(self::$config['master']['host'], self::$config['master']['port']);

        //} catch (Exception $e) {

        //}

        return self::$_rd;
    }

	public function get($key){

        $key = $this->_key($key);
		$value = self::init()->get($key);

        return $value ? unserialize($value) : false;

	}

    public function set($key, $value, $expire = null) {

        $value = serialize($value);
        $key = $this->_key($key);
        $expire = intval($expire);

        return $expire ? self::init()->setex($key, $expire, $value) : self::init()->set($key, $value);

    }

    public function hset($name, $prefix, $data) {
        $this->init_master();
        if (!$this->enable || !is_array($data) || empty($data)) return false;
        $this->type = $prefix;
        foreach ($data as $key => $value) {
            if ($value[0] == 'exp') {
                $value[1] = str_replace(' ', '', $value[1]);
                preg_match('/^[A-Za-z_]+([+-]\d+(\.\d+)?)$/',$value[1],$matches);
                if (is_numeric($matches[1])) {
                    $this->hIncrBy($name, $prefix, $key, $matches[1]);
                }
                unset($data[$key]);
            }
        }
        if (count($data) == 1) {
            $this->handler->hset($this->_key($name), key($data),current($data));
        } elseif (count($data) > 1) {
            $this->handler->hMset($this->_key($name), $data);
        }
    }

    public function hget($name, $prefix, $key = null) {
        $this->init_slave();
        if (!$this->enable) return false;
        $this->type = $prefix;
        if ($key == '*' || is_null($key)) {
            return $this->handler->hGetAll($this->_key($name));
        } elseif (strpos($key,',') != false) {
            return $this->handler->hmGet($this->_key($name), explode(',',$key));
        } else {
            return $this->handler->hget($this->_key($name), $key);
        }
    }

    public function hdel($name, $prefix, $key = null) {
        $this->init_master();
        if (!$this->enable) return false;
        $this->type = $prefix;
        if (is_null($key)) {
            if (is_array($name)) {
                return $this->handler->delete(array_walk($array,array(self,'_key')));
            } else {
                return $this->handler->delete($this->_key($name));
            }
        } else {
            if (is_array($name)) {
                foreach ($name as $key => $value) {
                    $this->handler->hdel($this->_key($name), $key);
                }
                return true;
            } else {
                return $this->handler->hdel($this->_key($name), $key);
            }
        }
    }

    public function hIncrBy($name, $prefix, $key, $num = 1) {
        if ($this->hget($name, $prefix,$key) !== false) {
            $this->handler->hIncrByFloat($this->_key($name), $key, floatval($num));
        }
    }

    public function rm($key) {
        $key = $this->_key($key);
        return self::init()->delete($key);
    }

    public function clear() {
        return self::init()->flushDB();
    }

	private function _key($str) {
        $this->prefix = self::$config['prefix'] ? self::$config['prefix'] : substr(md5($_SERVER['HTTP_HOST']), 0, 6).'_';
        return $this->prefix.$str;
	}
}