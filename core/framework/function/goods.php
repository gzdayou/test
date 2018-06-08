<?php
/**
 * 商品图片统一调用函数
 *
 *
 *
 * @package    function* www.zhihuijia.com网店运维技术交流中心为你提供售后服务 以便你更好的了解
 */

/**
 * 取得商品缩略图的完整URL路径，接收商品信息数组，返回所需的商品缩略图的完整URL
 *
 * @param array $goods 商品信息数组
 * @param string $type 缩略图类型  值为60,240,360,1280
 * @return string
 */
function thumb($goods = array(), $type = '')
{
    $type_array = explode(',_', ltrim(GOODS_IMAGES_EXT, '_'));
    if (!in_array($type, $type_array)) {
        $type = '240';
    }
    if (empty($goods)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    if (array_key_exists('apic_cover', $goods)) {
        $goods['goods_image'] = $goods['apic_cover'];
    }
    if (empty($goods['goods_image'])) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    $search_array = explode(',', GOODS_IMAGES_EXT);
    $file = str_ireplace($search_array, '', $goods['goods_image']);
    $fname = basename($file);
    //取店铺ID
    if (preg_match('/^(\d+_)/', $fname)) {
        $store_id = substr($fname, 0, strpos($fname, '_'));
    } else {
        $store_id = $goods['store_id'];
    }
    $file = $type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file);
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $store_id . '/' . $file)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    $thumb_host = UPLOAD_SITE_URL . '/' . ATTACH_GOODS;
    return $thumb_host . '/' . $store_id . '/' . $file;

}

/**
 * 取得商品缩略图的完整URL路径，接收图片名称与店铺ID
 *
 * @param string $file 图片名称
 * @param string $type 缩略图尺寸类型，值为60,240,360,1280
 * @param mixed $store_id 店铺ID 如果传入，则返回图片完整URL,如果为假，返回系统默认图
 * @return string
 */
function cthumb($file, $type = '', $store_id = false)
{
    $type_array = explode(',_', ltrim(GOODS_IMAGES_EXT, '_'));
    if (!in_array($type, $type_array)) {
        $type = '240';
    }
    if (empty($file)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    $search_array = explode(',', GOODS_IMAGES_EXT);
    $file = str_ireplace($search_array, '', $file);
    $fname = basename($file);
    // 取店铺ID
    if ($store_id === false || !is_numeric($store_id)) {
        $store_id = substr($fname, 0, strpos($fname, '_'));
    }
    // 本地存储时，增加判断文件是否存在，用默认图代替
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $store_id . '/' . ($type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file)))) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage($type);
    }
    $thumb_host = UPLOAD_SITE_URL . '/' . ATTACH_GOODS;
    return $thumb_host . '/' . $store_id . '/' . ($type == '' ? $file : str_ireplace('.', '_' . $type . '.', $file));
}

/**
 * 商品二维码
 * @param array $goods_info
 * @return string
 */
function goodsQRCode($goods_info)
{
    if (!file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_STORE . '/' . $goods_info['store_id'] . '/' . $goods_info['goods_id'] . '.png')) {
        return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . 'default_qrcode.png';
    }
    return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $goods_info['store_id'] . DS . $goods_info['goods_id'] . '.png';
}

/**
 * 取得抢购缩略图的完整URL路径
 *
 * @param string $imgurl 商品名称
 * @param string $type 缩略图类型  值为small,mid,max
 * @return string
 */
function gthumb($image_name = '', $type = '')
{
    if (!in_array($type, array('small', 'mid', 'max'))) $type = 'small';
    if (empty($image_name)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    list($base_name, $ext) = explode('.', $image_name);
    list($store_id) = explode('_', $base_name);
    $file_path = ATTACH_GROUPBUY . DS . $store_id . DS . $base_name . '_' . $type . '.' . $ext;
    if (!file_exists(BASE_UPLOAD_PATH . DS . $file_path)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    return UPLOAD_SITE_URL . DS . $file_path;
}

/**
 * 取得买家缩略图的完整URL路径
 *
 * @param string $imgurl 商品名称
 * @param string $type 缩略图类型  值为240,1024
 * @return string
 */
function snsThumb($image_name = '', $type = '')
{
    if (!in_array($type, array('240', '1024'))) $type = '240';
    if (empty($image_name)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }

    list($member_id) = explode('_', $image_name);
    $file_path = ATTACH_MALBUM . DS . $member_id . DS . str_ireplace('.', '_' . $type . '.', $image_name);
    if (!file_exists(BASE_UPLOAD_PATH . DS . $file_path)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    return UPLOAD_SITE_URL . DS . $file_path;
}


/**
 * 取得积分商品缩略图的完整URL路径
 *
 * @param string $imgurl 商品名称
 * @param string $type 缩略图类型  值为small
 * @return string
 */
function pointprodThumb($image_name = '', $type = '')
{
    if (!in_array($type, array('small', 'mid'))) $type = '';
    if (empty($image_name)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }

    if ($type) {
        $file_path = ATTACH_POINTPROD . DS . str_ireplace('.', '_' . $type . '.', $image_name);
    } else {
        $file_path = ATTACH_POINTPROD . DS . $image_name;
    }
    if (!file_exists(BASE_UPLOAD_PATH . DS . $file_path)) {
        return UPLOAD_SITE_URL . '/' . defaultGoodsImage('240');
    }
    return UPLOAD_SITE_URL . DS . $file_path;
}

/**
 * 取得品牌图片
 *
 * @param string $image_name
 * @return string
 */
function brandImage($image_name = '')
{
    if ($image_name != '') {
        return UPLOAD_SITE_URL . '/' . ATTACH_BRAND . '/' . $image_name;
    }
    return UPLOAD_SITE_URL . '/' . ATTACH_COMMON . '/default_brand_image.gif';
}

/**
 * 取得订单状态文字输出形式
 *
 * @param array $order_info 订单数组
 * @return string $order_state 描述输出
 */
function orderState($order_info)
{
    switch ($order_info['order_state']) {
        case ORDER_STATE_CANCEL:
            $order_state = L('order_state_cancel') ? : '已取消';
            break;
        case ORDER_STATE_NEW:
            $order_state = L('order_state_new') ? : "待付款";
            break;
        case ORDER_STATE_PAY:
            $order_state = L('order_state_pay') ? : "待发货";
            break;
        case ORDER_STATE_SEND:
            $order_state = L('order_state_send') ? : "待收货";
            break;
        case ORDER_STATE_SUCCESS:
            $order_state = L('order_state_success') ? : "已完成";
            break;
    }
    return $order_state;
}

/**
 * 取得订单支付类型文字输出形式
 *
 * @param array $payment_code
 * @return string
 */
function orderPaymentName($payment_code)
{
    return str_replace(
        array('offline', 'online', 'alipay', 'tenpay', 'chinabank', 'predeposit', 'wxpay', 'xianxia', 'wx_wapapi', 'wx_jsapi'),
        array('货到付款', '在线付款', '支付宝', '财付通', '网银在线', '站内余额支付', '微信app支付', '线下支付', '微信公众号支付', '微信app支付'),
        $payment_code);
}

/**
 * 取得订单商品销售类型文字输出形式
 *
 * @param array $goods_type
 * @return string 描述输出
 */
function orderGoodsType($goods_type)
{
    return str_replace(array("1", "2", "3", "4", "5", "8", "9"), array("", "特卖", "限时折扣", "优惠套装", "赠品", "", "换购"), $goods_type);
}

/**
 * 取得结算文字输出形式
 *
 * @param array $bill_state
 * @return string 描述输出
 */
function billState($bill_state)
{
    return str_replace(array("1", "2", "3", "4"), array("已出账", "商家已确认", "平台已审核", "结算完成"), $bill_state);
}

function checkmobile($telphone)
{
    if (strlen($telphone) == "11") {

        $n = preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/", $telphone, $array);
        if ($array[0][0] == $telphone) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
        echo "长度必须是11位";
    }
}

function getImage($url,$save_dir='',$filename='',$type=0){
	if(trim($url)==''){
		return array('file_name'=>'','save_path'=>'','error'=>1);
	}
	if(trim($save_dir)==''){
		$save_dir='./';
	}
	if(trim($filename)==''){//保存文件名
		$ext=strrchr($url,'.');
		if($ext!='.gif'&&$ext!='.jpg'){
			return array('file_name'=>'','save_path'=>'','error'=>3);
		}
		$filename=time().$ext;
	}
	if(0!==strrpos($save_dir,'/')){
		$save_dir.='/';
	}
	//创建保存目录
	if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
		return array('file_name'=>'','save_path'=>'','error'=>5);
	}
	//获取远程文件所采用的方法
	if($type){
		$ch=curl_init();
		$timeout=5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$img=curl_exec($ch);
		curl_close($ch);
	}else{
		ob_start();
		readfile($url);
		$img=ob_get_contents();
		ob_end_clean();
	}
	//$size=strlen($img);
	//文件大小
	$fp2=@fopen($save_dir.$filename,'a');
	fwrite($fp2,$img);
	fclose($fp2);
	unset($img,$url);
	return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
}

/**
 * 订单来源显示
 */
function orderFrom( $from ,$buyer_name='')
{
	$from = str_replace( array(1,2), array('PC端','移动端'), $from );

    return $from;
}

defined('ByAcesoft') or exit('Access Invalid!');

?>
