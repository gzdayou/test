<?php
/**
 * 报警日志
 */
defined('ByAcesoft') or exit('Access Invalid!');
class log_errorModel extends Model {

    public function __construct() {
        parent::__construct('log_error');
    }

    /**
     * 动态记录列表
     *
     * @param $condition 条件
     * @param $page 分页
     * @param $field 查询字段
     * @return array 数组格式的返回结果
     */
    public function getAlarmlogList($condition, $pagesize = '', $field = '*', $order = 'id desc'){
        return $this->table('log_error')
            ->field($field)
            ->where($condition)
            ->page($pagesize)
            ->order($order)
            ->select();
    }

}
