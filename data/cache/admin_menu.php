<?php defined('ByAcesoft') or exit('Access Invalid!'); return array (
  'system' => 
  array (
    'name' => '系统首页',
    'child' => 
    array (
      0 => 
      array (
        'name' => '冷热源站',
        'child' => 
        array (
          'main_ace' => '冷热源站',
          'lyzj' => '冷源主机',
          'ldsb' => '冷冻水泵',
          'lqsb' => '冷却水泵',
          'rsb' => '热水泵',
          'tower' => '冷却塔',
          'vavel_control' => '阀门控制',
          'schedule' => '日程策略',
          'energy_ratio' => '实时能效比',
          'device_control' => '设备控制',
        ),
      ),
      1 => 
      array (
        'name' => '新风机组',
        'child' => 
        array (
          'page11' => '实时数据',
          'page12' => '新风控制',
        ),
      ),
      2 => 
      array (
        'name' => '公共照明',
        'child' => 
        array (
          'page13' => '实时数据',
          'page14' => '照明控制',
        ),
      ),
      3 => 
      array (
        'name' => '节能管理',
        'child' => 
        array (
          'real_elec' => '实时电量',
          'real_consum' => '能源监测',
          'energy_report' => '能耗报表',
          'energy_trend' => '能耗趋势',
        ),
      ),
    ),
  ),
  'analytics' => 
  array (
    'name' => '数据分析',
    'child' => 
    array (
      0 => 
      array (
        'name' => '分析',
        'child' => 
        array (
          'index' => '数据分析',
        ),
      ),
    ),
  ),
  'alarm' => 
  array (
    'name' => '报警管理',
    'child' => 
    array (
      0 => 
      array (
        'name' => '报警管理',
        'child' => 
        array (
          'index' => '报警列表',
        ),
      ),
    ),
  ),
  'repair' => 
  array (
    'name' => '维修信息',
    'child' => 
    array (
      0 => 
      array (
        'name' => '维修',
        'child' => 
        array (
          'index' => '维修信息',
        ),
      ),
    ),
  ),
  'logs' => 
  array (
    'name' => '运行日志',
    'child' => 
    array (
      0 => 
      array (
        'name' => '日志',
        'child' => 
        array (
          'index' => '日志列表',
        ),
      ),
    ),
  ),
  'users' => 
  array (
    'name' => '用户管理',
    'child' => 
    array (
      0 => 
      array (
        'name' => '用户',
        'child' => 
        array (
          'index' => '用户管理',
        ),
      ),
    ),
  ),
);