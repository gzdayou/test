<?php

/**
 * 简化版本curl post 请求
 *
 */

class CurlPost
{

    /**
     * post
     * @param string $url url
     * @param array $data 数据
     * @param bool $log 是否开启错误保存 默认curl 错误保存
     * @return string
     */
    public static function simple($url , $data , $log = true)
    {
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, 1 );
        curl_setopt ( $ch, CURLOPT_HEADER, 0 );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
        $return = curl_exec ( $ch );
        $curl_error = curl_error($ch);
        $curl_errno = curl_errno($ch);
        curl_close ( $ch );
        if ($curl_errno && $log) {
            $msg = "curl错误码是：" . $curl_errno . " 错误信息是: " . $curl_error;
            Log::selflog($msg);
        }
        return $return ;
    }
}







