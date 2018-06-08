<?php
/**
 * 菜单
 */
defined('ByAcesoft') or exit('Access Invalid!');

$_menu['users'] = array(
        'name' => '用户管理',
        'child' => array(
                array(
                        'name' => '用户',
                        'child' => array(
                                'index' => '用户管理',
                        )),
                
));
