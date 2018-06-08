<?php
/**
 * 菜单
 *
 *
 */
defined('ByAcesoft') or exit('Access Invalid!');

$_menu['alarm'] = array(
        'name' => '报警管理',
        'child' => array(
                array(
                        'name' => '报警管理',
                        'child' => array(
                                'index' => '报警列表'
                        )),
));
