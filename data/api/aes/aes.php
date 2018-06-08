<?php 
class AESMcrypt {

public $iv = null;
public $key = null;
public $bit = 128;
private $cipher;

public function __construct($bit, $key, $iv, $mode) {
if(empty($bit) || empty($key) ||  empty($mode))
return NULL;

$this->bit = $bit;
$this->key = $key;
$this->iv = $iv;
$this->mode = $mode;

switch($this->bit) {
case 192:$this->cipher = MCRYPT_RIJNDAEL_192; break;
case 256:$this->cipher = MCRYPT_RIJNDAEL_256; break;
default: $this->cipher = MCRYPT_RIJNDAEL_128;
}

switch($this->mode) {
case 'ecb':$this->mode = MCRYPT_MODE_ECB; break;
case 'cfb':$this->mode = MCRYPT_MODE_CFB; break;
case 'ofb':$this->mode = MCRYPT_MODE_OFB; break;
case 'nofb':$this->mode = MCRYPT_MODE_NOFB; break;
default: $this->mode = MCRYPT_MODE_CBC;
}
}

public function setKey($token = '654321') {

	$this->_secrect_key =  pack('H*',    md5($token));

}

/**
 * 填充算法
 * @param string $source
 * @return string
 */

function addPKCS7Padding($source)
{
	$source = trim($source);
	$block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'ecb');
	$pad = $block - (strlen($source) % $block);
	if ($pad <= $block) {
		$char = chr($pad);
		$source .= str_repeat($char, $pad);
	}
	return $source;
}

/**
 * 移去填充算法
 * @param string $source
 * @return string
 */
function stripPKSC7Padding($source)
{
	$source = trim($source);
	$char = substr($source, -1);
	$num = ord($char);
	if ($num == 62) return $source;
	$source = substr($source, 0, -$num);
	return $source;
}


/**
     * 加密方法
     * @param string $str
     * @return string
     */
    public function encrypt($str)
    {
        $screct_key = $this->key;
        $str = $this->addPKCS7Padding($str);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $encrypt_str = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $screct_key, $str, MCRYPT_MODE_ECB, $iv);

        return bin2hex($encrypt_str);
    }

/**
     * 解密方法
     * @param string $str
     * @return string
     */
    public function decrypt($str)
    {
        $screct_key = $this->key;
        $str = hex2bin($str);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $encrypt_str = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $screct_key, $str, MCRYPT_MODE_ECB, $iv);
        $encrypt_str = trim($encrypt_str);
        $encrypt_str = $this->stripPKSC7Padding($encrypt_str);
        return base64_decode($encrypt_str);
    }

}