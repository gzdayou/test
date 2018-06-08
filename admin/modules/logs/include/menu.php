<?php
/**
 * 菜单
 *
 *
 */
defined('ByAcesoft') or exit('Access Invalid!');

$_menu['logs'] = array(
        'name' => '运行日志',
        'child' => array(
                array(
                        'name' => '日志',
                        'child' => array(
                                'index' => '日志列表',
                        )),
                
));
