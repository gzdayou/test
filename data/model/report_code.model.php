<?php
/**
 * 冷冻机组报表
 */
defined('ByAcesoft') or exit('Access Invalid!');
class report_codeModel extends Model {

    public function __construct() {
        parent::__construct('report_code');
    }

    /**
     * 动态记录列表
     *
     * @param $condition 条件
     * @param $page 分页
     * @param $field 查询字段
     * @return array 数组格式的返回结果
     */
    public function getReportList($condition, $pagesize = '', $field = '*', $order = 'id desc'){
        return $this->table('report_code')
            ->field($field)
            ->where($condition)
            ->page($pagesize)
            ->order($order)
            ->select();
    }

}
