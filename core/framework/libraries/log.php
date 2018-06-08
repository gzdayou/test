<?php
/**
 * 记录日志 
 *
 *
 */
defined('ByAcesoft') or exit('Access Invalid!');
class Log{

    const SQL       = 'SQL';
    const ERR       = 'ERR';
    private static $log =   array();

    public static function record($message,$level=self::ERR) {
        $now = @date('Y-m-d H:i:s',time());
        switch ($level) {
            case self::SQL:
               self::$log[] = "[{$now}] {$level}: {$message}\r\n";
               break;
            case self::ERR:
                $log_file = BASE_DATA_PATH.'/log/'.date('Ymd',TIMESTAMP).'.log';
                $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
                $url .= " ( act={$_GET['act']}&op={$_GET['op']} ) ";
                $content = "[{$now}] {$url}\r\n{$level}: {$message}\r\n";
                file_put_contents($log_file,$content, FILE_APPEND);
                break;
        }
    }

    public static function read(){
    	return self::$log;
    }
    
    /**
     * 指定日志tag名，根据tag名生成每日日志。一次记录一行
     *
     * @param $data
     * @param string $log_tag
     * @param string $method
     * @param int $iflock
     * @param int $chmod
     */
    static public function selflog($data, $log_tag= 'common', $method = "a+", $iflock = 1, $chmod = 1) {
    	$retmsgSavePath = BASE_DATA_PATH . "/log/dump/";
    	$filename = $retmsgSavePath . $log_tag . date('Ymd') . ".log";
    	touch($filename);
    	$handle = fopen($filename, $method);
    	if ($iflock) {
    		flock($handle, LOCK_EX);
    	}
    	$data = '[' . date('Y-m-d H:i:s') . ']-->' . $data . "\n";
    	fwrite($handle, $data);
    	if ($method == "rb+")
    		ftruncate($handle, strlen($data));
    	fclose($handle);
    	$chmod && @chmod($filename, 0744);
    }
}