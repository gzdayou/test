<?php
/**
 * 菜单
 *
 *
 */
defined('ByAcesoft') or exit('Access Invalid!');

$_menu['repair'] = array(
        'name' => '维修信息',
        'child' => array(
                array(
                        'name' => '维修',
                        'child' => array(
                                'index' => '维修信息',
                        )),
));