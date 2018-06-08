<?php
/**
 * 菜单
 */
defined('ByAcesoft') or exit('Access Invalid!');
$_menu['system'] = array (
        'name' => '系统首页',
        'child' => array (
                array(
                        'name' => "冷热源站",
                        'child' => array(
                                'main_ace' => "冷热源站",
                                'lyzj' => '冷源主机',
                                //'ryzj' => '热源主机',
                                'ldsb' => '冷冻水泵',
                                'lqsb' => "冷却水泵",
                                'rsb' => '热水泵',
                                'tower' => "冷却塔",
                                'vavel_control' => "阀门控制",
                                'schedule' => "日程策略",
                                'energy_ratio' => "实时能效比",
                                'device_control' => "设备控制"
                        )
                ),
                array(
                        'name' => "新风机组",
                        'child' => array(
                                'page11' => "实时数据",
                                'page12' => "新风控制"
                        )
                ),
                array(
                        'name' => "公共照明",
                        'child' => array(
                                'page13' => "实时数据",
                                'page14' => "照明控制",
                        )
                ),
		array(
                        'name' => '节能管理',
                        'child' => array(
                                'real_elec' => '实时电量',
                                //'real_consum' => '能源监测',
                                'energy_report' => '能耗报表',
                                'energy_trend' => '能耗趋势',
                                'energy_analys' => '能耗分析'
                        )
                )
        ) 
);
