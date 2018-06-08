<?php
/**
 * 菜单
 *
 *
 */
defined('ByAcesoft') or exit('Access Invalid!');

$_menu['reports'] = array(
        'name' => '数据报表',
        'child' => array(
                array(
                        'name' => '设置',
                        'child' => array(
                                'setting' => '商城设置',
                                'upload' => '图片设置',
                                'search' => '搜索设置',
                                'seo' => $lang['nc_seo_set'],
                                'message' => $lang['nc_message_set'],
                                'payment' => $lang['nc_pay_method'],
                                'express' => $lang['nc_admin_express_set'],
                                'waybill' => '运单模板',
                                'web_config' => '首页管理',
                                'web_channel' => '频道管理'
                        )),
                
));
