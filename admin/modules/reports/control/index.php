<?php
/**
 * 报表管理
*/

defined('ByAcesoft') or exit('Access Invalid!');

class indexControl extends SystemControl{

	private $links = array(
			array('url'=>'act=index&op=code_reports','text'=>'冷冻机组'),
			array('url'=>'act=index&op=part_reports','text'=>'分项电耗'),
			array('url'=>'act=index&op=total_reports','text'=>'年总能耗')
	);
	public function __construct(){
		parent::__construct();
		Language::read('web_config');
	}
	
	public function indexOp() {
		$this->code_reportsOp();
	}
	
	/**
	 * 冷冻机组
	 */
	public function code_reportsOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'code_reports'));
		Tpl::setDirquna('reports');
		Tpl::showpage('codeReports.list');
	}
	
	/**
	 * 输出冷冻机组XML数据
	 */
	public function get_code_xmlOp() {
		$model_report = Model('report_code');
	
		$page = intval($_POST['rp']);
		if ($page < 1) {
			$page = 15;
		}
		$condition = array();
		if ($_POST['qtype'] == 'channel_name') {
			//$condition[$_POST['qtype']] = array('like', '%' . trim($_POST['query']) . '%');
		}
		$list = $model_report->getReportList($condition,$page);
		
		$out_list = array();
		if (!empty($list) && is_array($list)){
			foreach ($list as $k => $v){
				$param = array();
				$param['date'] = $v['date'];
				$param['collum1'] = $v['collum1'];
				$param['collum2'] = $v['collum2'];
				$param['collum3'] = $v['collum3'];
				$param['collum4'] = $v['collum4'];
				$param['collum5'] = $v['collum5'];
				$param['collum6'] = $v['collum6'];
				
				$out_list[$v['id']] = $param;
			}
		}
	
		$data = array();
		$data['now_page'] = $model_report->shownowpage();
		$data['total_num'] = $model_report->gettotalnum();
		$data['list'] = $out_list;
		echo Tpl::flexigridXML($data);exit();
	}
	
	/**
	 * 分项电耗
	 */
	public function part_reportsOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'part_reports'));
		Tpl::setDirquna('reports');
		Tpl::showpage('partReports.list');
	}
	
	/**
	 * 输出分项电耗XML数据
	 */
	public function get_part_xmlOp() {
		/* $model_report = Model('report_code');
	
		$page = intval($_POST['rp']);
		if ($page < 1) {
			$page = 15;
		}
		$condition = array();
		if ($_POST['qtype'] == 'channel_name') {
			//$condition[$_POST['qtype']] = array('like', '%' . trim($_POST['query']) . '%');
		}
		$list = $model_report->getReportList($condition,$page); */
		
		$list = array(
			array('id' => 1, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),	
			array('id' => 2, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 3, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 4, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 5, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 6, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 7, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 8, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 9, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 10, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 11, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 12, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 13, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 14, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
			array('id' => 15, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃')
		) ;
	
		$out_list = array();
		if (!empty($list) && is_array($list)){
			foreach ($list as $k => $v){
				$id = $v['id'];
				unset($v['id']);
	
				$out_list[$id] = $v;
			}
		}
	
		$data = array();
		$data['now_page'] = 1;
		$data['total_num'] = 15;
		$data['list'] = $out_list;
		echo Tpl::flexigridXML($data);exit();
	}
	
	/**
	 * 分项电耗
	 */
	public function total_reportsOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'total_reports'));
		Tpl::setDirquna('reports');
		Tpl::showpage('totalReports.list');
	}
	
	/**
	 * 输出分项电耗XML数据
	 */
	public function get_total_xmlOp() {
		/* $model_report = Model('report_code');
	
		$page = intval($_POST['rp']);
		if ($page < 1) {
		$page = 15;
		}
		$condition = array();
		if ($_POST['qtype'] == 'channel_name') {
		//$condition[$_POST['qtype']] = array('like', '%' . trim($_POST['query']) . '%');
		}
		$list = $model_report->getReportList($condition,$page); */
	
		$list = array(
				array('id' => 1, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 2, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 3, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 4, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 5, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 6, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 7, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 8, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 9, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 10, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 11, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 12, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 13, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 14, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃'),
				array('id' => 15, 'date' => '2017-10-15 10:37:23', 'collum1' => '37℃', 'collum2' => '63℃', 'collum3' => '63℃', 'collum4' => '63℃')
		) ;
	
		$out_list = array();
		if (!empty($list) && is_array($list)){
			foreach ($list as $k => $v){
				$id = $v['id'];
				unset($v['id']);
	
				$out_list[$id] = $v;
			}
		}
	
		$data = array();
		$data['now_page'] = 1;
		$data['total_num'] = 15;
		$data['list'] = $out_list;
		echo Tpl::flexigridXML($data);exit();
	}

}
