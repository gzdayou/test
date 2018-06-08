<?php
/**
 * 报警管理
*/

defined('ByAcesoft') or exit('Access Invalid!');

class indexControl extends SystemControl{
	
	public function __construct(){
		parent::__construct();
	}

	public function indexOp() {
		$this->alarmOp();
	}

	/**
	 * 报警列表
	 */
	public function alarmOp(){
		$model = Model();
		$alarm_log_list = $model->table('log_error')->limit(200)->select();

		Tpl::output('alarm_log_list',$alarm_log_list);
		Tpl::output('page',$model->showpage());
		//Tpl::output('alarm_types',$this -> _alarmTypes());

		Tpl::setDirquna('alarm');
		Tpl::showpage('alarm.index');
	}
	
	private function _devices(){
        $model = Model();
        $list = $model->table('devices')->select();
        return array_column($list, 'DeviceName', 'DeviceID');
	}

    /**
     * 输出XML数据
     */
    public function get_xmlOp() {
        $alarmlog_model = Model('log_error');
        $condition = array();
        if ($_POST['query'] != '') {
            //$condition[$_POST['qtype']] = $_POST['query'];
        }
        // //分页
        // $page   = new Page();
        // $page->setEachNum($_POST['rp']);
        // $page->setStyle('admin');
        $log_list = $alarmlog_model->getAlarmlogList($condition, $_POST['rp']);

        $data = array();
        $data['now_page'] = $alarmlog_model->shownowpage();
        $data['total_num'] = $alarmlog_model->gettotalnum();
        $_devices = $this -> _devices();
        foreach ($log_list as $value) {
            $param = array();
            $param['alarm_time'] = $value['RecordTime'];
            $param['device'] = $_devices[$value['DeviceID']];
            $param['error_info'] = $value['ErrorInfo'];
            $data['list'][$value['ID']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

}
