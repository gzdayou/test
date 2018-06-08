<?php
/**
 * 日志管理
*/

defined('ByAcesoft') or exit('Access Invalid!');

class indexControl extends SystemControl{

	private $links = array(
			array('url'=>'act=index&op=index','text'=>'用户操作日志'),
			// array('url'=>'act=index&op=part_reports','text'=>'故障报警日志'),
			// array('url'=>'act=index&op=total_reports','text'=>'子系统运行日志')
	);

    public function __construct(){
        parent::__construct();
        Language::read('admin_log');
    }

    public function indexOp() {
        $this->listOp();
    }

    /**
     * 日志列表
     *
     */
    public function listOp(){
    	Tpl::output('top_link',$this->sublink($this->links, 'index'));
        Tpl::setDirquna('logs');
        Tpl::showpage('admin_log.index');
    }

    public function get_xmlOp(){
        $model = Model('admin_log');
        $condition  = array();
        list($condition,$order) = $this->_get_condition($condition);
        $list = $model->where($condition)->order($order)->page($_POST['rp'])->select();
        $data = array();
        $data['now_page'] = $model->shownowpage();
        $data['total_num'] = $model->gettotalnum();
        foreach ($list as $k => $info) {
            $list = array();
            $list['operation'] = "<a class='btn red' onclick=\"fg_delete({$info['id']})\"><i class='fa fa-trash-o'></i>删除</a>";
            $list['admin_name'] = $info['admin_name'];
            $list['content'] = $info['content'];
            $list['createtime'] = date('Y-m-d H:i:s',$info['createtime']);
            $list['ip'] = $info['ip'];
            $data['list'][$info['id']] = $list;
        }
        exit(Tpl::flexigridXML($data));
    }
    
    /**
     * 封装公共代码
     */
    private function _get_condition($condition) {
    	if ($_REQUEST['query'] != '' && in_array($_REQUEST['qtype'],array('admin_name','content'))) {
    		$condition[$_REQUEST['qtype']] = array('like',"%{$_REQUEST['query']}%");
    	}
    	if ($_GET['admin_name'] != '') {
    		$condition['admin_name'] = array('like',"%{$_GET['admin_name']}%");
    	}
    	if ($_GET['content'] != '') {
    		$condition['content'] = array('like',"%{$_GET['content']}%");
    	}
    	if ($_GET['ip'] != '') {
    		$condition['ip'] = array('like',"%{$_GET['ip']}%");
    	}
    	$if_start_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_start_date']);
    	$if_end_time = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_end_date']);
    	$start_unixtime = $if_start_time ? strtotime($_GET['query_start_date']) : null;
    	$end_unixtime = $if_end_time ? strtotime($_GET['query_end_date']): null;
    	if ($start_unixtime || $end_unixtime) {
    		$condition['createtime'] = array('time',array($start_unixtime,$end_unixtime));
    	}
    	$sort_fields = array('admin_name','id');
    	if ($_REQUEST['sortorder'] != '' && in_array($_REQUEST['sortname'],$sort_fields)) {
    		$order = $_REQUEST['sortname'].' '.$_REQUEST['sortorder'];
    	}
    	return array($condition,$order);
    }

}
