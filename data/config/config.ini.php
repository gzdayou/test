<?php

$config = array();
$config['admin_site_url']       = 'http://47.97.117.107/ACE_Web_HYRMYY/admin';
$config['upload_site_url']      = 'http://47.97.117.107/ACE_Web_HYRMYY/data/upload';
$config['resource_site_url']    = 'http://47.97.117.107/ACE_Web_HYRMYY/data/resource';
$config['setup_date']           = '2018-04-18 12:00:00';
$config['gip']                  = 0;
$config['dbdriver']             = 'mysql';
$config['tablepre']             = 't_';

$config['db']['1']['dbhost']    = 'localhost';
$config['db']['1']['dbuser']    = 'root';
$config['db']['1']['dbpwd']     = 'ZoneSmart';
$config['db']['1']['dbport']    = '3306';
$config['db']['1']['dbname']    = 'ace_hyrmyy';
$config['db']['1']['dbcharset'] = 'UTF-8';
$config['db']['slave']          = $config['db']['master'];
$config['session_expire']       = 3600;
$config['lang_type']            = 'zh_cn';
$config['cookie_pre']           = 'ZHJ_';
$config['cookie_domain']        = '47.97.117.107';
$config['cache_open']           = false;
$config['redis']['prefix']         = 'nc_';
$config['redis']['master']['port'] = 6379;
$config['redis']['master']['host'] = '127.0.0.1';
$config['redis']['pconnect']       = 0;
$config['redis']['slave']         = array(
    'host' => '47.97.117.107',
    'port' => '6379',
);

//zmq配置
$config['zmq_addr'] = "tcp://localhost:15885";
$config['work_station'] = "HYRMYY";
//节能比率
$config['save_energy_ratio'] = 0.3 ;
$config['save_co2_ratio']    = 0.4 ;
$config['save_money_ratio']  = 0.28 ;
//ajax定时器间隔
$config['ajax_time'] = 8000; 
//阀门
$config['vavel'] = array(
    "SWITCH_ESS1-" => array(
                        "主机1冷冻水回水阀",
                        "主机1冷却水回水阀",
                        "主机2冷冻水回水阀",
                        "主机2冷却水回水阀",
                        "主机3冷冻水回水阀",
                        "主机3冷却水回水阀",
                        "主机4冷冻水回水阀",
                        "主机4冷却水回水阀",
                        "冬夏转换阀1",
                        "冬夏转换阀2",
                        "冬夏转换阀3",
                        "冬夏转换阀4",
                        "热水供水阀1",
                        "热水供水阀2",
                        "备用",
                        "备用"
                        )
) ;
//项目名
$config['project'] = "衡阳县人民医院";

return $config;
