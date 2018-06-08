<?php
/**
 * 报表管理
*/

defined('ByAcesoft') or exit('Access Invalid!');

class indexControl extends SystemControl{

	private $links = array(
		array('url'=>'act=index&op=system_cop','text'=>'系统COP'),
		array('url'=>'act=index&op=host_cop','text'=>'主机COP'),
		array('url'=>'act=index&op=ldb_analytics','text'=>'冷冻泵分析'),
		array('url'=>'act=index&op=lqb_analytics','text'=>'冷却泵分析'),
		array('url'=>'act=index&op=comb_analytics','text'=>'综合数据分析')
	);
	public function __construct(){
		parent::__construct();
		Language::read('web_config');
		Tpl::output('wdate', date('Y-m-d') );
		Tpl::output('wdate_day', date('Y-m-d') );
		Tpl::output('wdate_month', date('Y-m') );
	}
	
	public function indexOp() {
		$this->system_copOp();
	}
	
	/**
	 * 系统COP数据分析
	 */
	public function system_copOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'system_cop'));
		Tpl::setDirquna('analytics');
		Tpl::showpage('system_cop.list');
	}
	/**
	 * 系统cop页面ajax数据获取
	 */
	public function get_syscop_ajaxOp() {
		if( $_GET['wdate'] == "" || $_GET['date_type'] == "" ) {
			$result = array('status' => 0, 'msg' => '参数为空', 'data'=>'');
			die(json_encode($result));
		}

		$model = Model();
		//按日
		if( $_GET['date_type'] == 1 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = 100 ;
			$condition['RealCoeff'] = array('egt', 2);
			$res_avg = $model->table('devicerealtime')->field("HOUR (RecordTime) AS hours, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('hours')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'hours');
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = array('egt', 100) ;
			$condition['DeviceID'] = array('lt', 200) ;
			$res_sysinfo = $model->table('acedevday')->field("SUM(DayEnergy*AvgCoeff) as ttCooling, SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]));
			die(json_encode($result));
		}
		//按月
		if( $_GET['date_type'] == 2 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = 100 ;
			$condition['RealCoeff'] = array('egt', 2);
			$res_avg = $model->table('devicerealtime')->field("DAY (RecordTime) AS days, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('days')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'days');
			$tmp = explode("-", $_GET['wdate']);
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = array('egt', 100) ;
			$condition['DeviceID'] = array('lt', 200) ;
			$res_sysinfo = $model->table('acedevday')->field("SUM(DayEnergy*AvgCoeff) as ttCooling, SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]), 'days' => cal_days_in_month(CAL_GREGORIAN, $tmp[1], $tmp[0]));
			die(json_encode($result));
		}
	}
	
	/**
	 * 主机cop页面展示
	 */
	public function host_copOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'host_cop'));
		Tpl::setDirquna('analytics');
		Tpl::showpage('host_cop.list');
	}
	/**
	 * 主机cop页面ajax数据获取
	 */
	public function get_hostcop_ajaxOp() {
		if( $_GET['wdate'] == "" || $_GET['date_type'] == "" ) {
			$result = array('status' => 0, 'msg' => '参数为空', 'data'=>'');
			die(json_encode($result));
		}

		$model = Model();
		$device = $_GET['device'];
		//按日
		if( $_GET['date_type'] == 1 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['RealCoeff'] = array('egt', 2);
			$condition['DeviceID'] = $device;
			$res_avg = $model->table('devicerealtime')->field("HOUR (RecordTime) AS hours, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('hours')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'hours');
			//echo $model->getLastSql();exit;
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = $device;
			$res_sysinfo = $model->table('acedevday')->field("SUM(DayEnergy*AvgCoeff) as ttCooling, SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//echo $model->getLastSql();exit;
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]));
			die(json_encode($result));
		}
		//按月
		if( $_GET['date_type'] == 2 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['RealCoeff'] = array('egt', 2);
			$condition['DeviceID'] = $device;
			$res_avg = $model->table('devicerealtime')->field("DAY (RecordTime) AS days, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('days')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'days');
			$tmp = explode("-", $_GET['wdate']);
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = $device;
			$res_sysinfo = $model->table('acedevday')->field("SUM(DayEnergy*AvgCoeff) as ttCooling, SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]), 'days' => cal_days_in_month(CAL_GREGORIAN, $tmp[1], $tmp[0]));
			die(json_encode($result));
		}
	}

	/**
	 * 冷冻泵分析页面展示
	 */
	public function ldb_analyticsOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'ldb_analytics'));
		Tpl::setDirquna('analytics');
		Tpl::showpage('ldb_analytics.list');
	}
	/**
	 * 冷却泵分析页面展示
	 */
	public function lqb_analyticsOp() {
		Tpl::output('top_link',$this->sublink($this->links, 'lqb_analytics'));
		Tpl::setDirquna('analytics');
		Tpl::showpage('lqb_analytics.list');
	}
	/**
	 * 设备ajax数据获取
	 */
	public function device_analytics_ajaxOp() {
		if( $_GET['wdate'] == "" || $_GET['date_type'] == "" ) {
			$result = array('status' => 0, 'msg' => '参数为空', 'data'=>'');
			die(json_encode($result));
		}

		$model = Model();
		$device = $_GET['device'];
		//按日
		if( $_GET['date_type'] == 1 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['RealCoeff'] = array('egt', 2);
			$condition['DeviceID'] = $device;
			$res_avg = $model->table('devicerealtime')->field("HOUR (RecordTime) AS hours, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('hours')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'hours');
			//echo $model->getLastSql();exit;
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = $device;
			$res_sysinfo = $model->table('acedevday')->field("SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//echo $model->getLastSql();exit;
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]));
			die(json_encode($result));
		}
		//按月
		if( $_GET['date_type'] == 2 ) {
			$condition = array();
			$condition['RecordTime'] = array('like', $_GET['wdate']."%");
			$condition['RealCoeff'] = array('egt', 2);
			$condition['DeviceID'] = $device;
			$res_avg = $model->table('devicerealtime')->field("DAY (RecordTime) AS days, FORMAT(AVG(`RealCoeff`),2) as avgcop")->where($condition)->group('days')->select();
			$avgcop = array_column($res_avg, 'avgcop', 'days');
			$tmp = explode("-", $_GET['wdate']);
			//系统信息
			$condition = array();
			$condition['RecordDate'] = array('like', $_GET['wdate']."%");
			$condition['DeviceID'] = $device;
			$res_sysinfo = $model->table('acedevday')->field("SUM(`TotalEnergy`) as ttEnergy, SUM(`DayRunTime`) as ttRun, AVG(`AvgCoeff`) as avgcop")->where($condition)->select();
			//返回数据
			$result = array('status' => 1, 'msg' => 'succ', 'data' => array('avgcop' => $avgcop, 'sysinfo' => $res_sysinfo[0]), 'days' => cal_days_in_month(CAL_GREGORIAN, $tmp[1], $tmp[0]));
			die(json_encode($result));
		}
	}

	/**
	 * 综合分析页面展示
	 */
	public function comb_analyticsOp() {
		$begin = date("Y-m-d",strtotime("-30 day")) ;
		$end = date('Y-m-d') ;
		// $begin = "2018-01-01";
		// $end = "2018-02-01";
		Tpl::output('begin', $begin );
		Tpl::output('end', $end );
		Tpl::output('top_link',$this->sublink($this->links, 'comb_analytics'));
		Tpl::setDirquna('analytics');
		Tpl::showpage('comb_analytics.list');
	}

	/**
	 * 综合分析ajax数据获取
	 */
	public function comb_analytics_ajaxOp() {
		switch ( $_GET['comb_type'] ) {
			case 1 ://系统总耗电量
				$data = $this -> _get_system_total_energy($_GET['begin'], $_GET['end']) ;
				break;
			// case 2 ://系统总功率
			// 	$data = $this -> _get_system_total_power($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 3 ://系统总制冷量
			// 	$data = $this -> _get_system_total_refrigerator($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 4 ://系统运行时间
			// 	$data = $this -> _get_system_total_time($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 5 ://系统COP值
			// 	$data = $this -> _get_system_cop($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 6 ://系统当天节省电量
			// 	$data = $this -> _get_system_saveenergy_day($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 7 ://系统当天CO2减排量
			// 	$data = $this -> _get_system_saveco2_day($_GET['begin'], $_GET['end']) ;
			// 	break;
			// case 8 ://系统当天节省费用
			// 	$data = $this -> _get_system_savemoney_day($_GET['begin'], $_GET['end']) ;
			// 	break;
			case 9 ://主机电量
				$data = $this -> _get_host_energy($_GET['begin'], $_GET['end']) ;
				break;
			case 10 ://冷冻泵电量
				$data = $this -> _get_ldb_energy($_GET['begin'], $_GET['end']) ;
				break;
			case 11 ://冷却泵电量
				$data = $this -> _get_lqb_energy($_GET['begin'], $_GET['end']) ;
				break;
			case 12 ://热水泵电量
				$data = $this -> _get_rsb_energy($_GET['begin'], $_GET['end']) ;
				break;
			case 13 ://冷却泵电量
				$data = $this -> _get_lqt_energy($_GET['begin'], $_GET['end']) ;
				break;
			default :
				$data = array();
				break;
		}

		$total_energy = $this -> _get_save_data($_GET['begin'], $_GET['end']) ;
		$save_data = array();
		$save_data['save_energy'] = round($total_energy[0]['yval'] * C('save_energy_ratio'), 2);
		$save_data['save_co2'] = round($total_energy[0]['yval'] * C('save_co2_ratio'), 2);
		$save_data['save_money'] = round($total_energy[0]['yval'] * C('save_money_ratio'), 2);
		$result = array('status' => 1, 'msg' => 'succ', 'data' => $data, 'save_data' => $save_data);
		
		die(json_encode($result));
	}

	//获取节能数据
	private function _get_save_data($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` IN (101,102,103,201,202,203,301,302,303,501,502,503)
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a";
		$res = $model -> query( $sql );
		return $res;
	}

	//获取系统总耗电量
	private function _get_system_total_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` IN (101,102,103,201,202,203,301,302,303,501,502,503)
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//获取系统总功率
	private function _get_system_total_power($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.power) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`RealPower`) AS power FROM `t_devicerealtime`
				WHERE `DeviceID` IN (101,102,103,201,202,203,301,302,303,501,502,503)
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//获取系统总制冷量
	private function _get_system_total_refrigerator($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.refrigerator) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`Refrigerator`) AS refrigerator FROM `t_hostrealtime`
				WHERE RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	} 
	
	//获取系统总运行时间
	private function _get_system_total_time($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.ctime) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurTime`) AS ctime FROM `t_devicerealtime`
				WHERE `DeviceID` IN (101,102,103,201,202,203,301,302,303,501,502,503)
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//获取系统COP值
	private function _get_system_cop($begin, $end) {
		$model = Model();
		$condition = "`RecordTime` >= '".$begin."' AND `RecordTime` <= '". $end ."'";
		$res = $model->table('hostrealtime')
					->field("CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, AVG(`RealCOP`) AS yval")
					->where($condition)
					->group('days')
					->select();
		return $res ;
	}

	//系统当天节省电量
	private function _get_system_saveenergy_day($begin, $end) {
		$energy = $this -> _get_system_total_energy($begin, $end);
		$result = array() ;
		foreach( $energy as $k => $v ) {
			$result[$k]['days'] = $v['days'];
			$result[$k]['yval'] = $v['yval'] * C("save_energy_ratio") ;
		}

		return $result ;
	}

	//系统当天CO2减排量
	private function _get_system_saveco2_day($begin, $end) {
		$energy = $this -> _get_system_total_energy($begin, $end);
		$result = array() ;
		foreach( $energy as $k => $v ) {
			$result[$k]['days'] = $v['days'];
			$result[$k]['yval'] = $v['yval'] * C("save_co2_ratio") ;
		}

		return $result ;
	}

	//系统当天节省费用
	private function _get_system_savemoney_day($begin, $end) {
		$energy = $this -> _get_system_total_energy($begin, $end);
		$result = array() ;
		foreach( $energy as $k => $v ) {
			$result[$k]['days'] = $v['days'];
			$result[$k]['yval'] = $v['yval'] * C("save_money_ratio") ;
		}

		return $result ;
	}

	//主机电量
	private function _get_host_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_hostrealtime`
				WHERE RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//冷冻泵电量
	private function _get_ldb_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` LIKE '20%'
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//冷却泵电量
	private function _get_lqb_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` LIKE '30%'
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//热水泵电量
	private function _get_rsb_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` LIKE '40%'
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}

	//冷却塔电量
	private function _get_lqt_energy($begin, $end) {
		$model = Model();
		$condition = array();
		$sql = "SELECT a.days, SUM(a.energy) AS yval FROM (
				SELECT CONCAT(MONTH (RecordTime), '.', DAY (RecordTime) ) AS days, `DeviceID`, MAX(`CurEnergy`) AS energy FROM `t_devicerealtime`
				WHERE `DeviceID` LIKE '50%'
				AND RecordTime >= '".$begin."' AND RecordTime <= '".$end."'
				GROUP BY days, `DeviceID`
				) AS a GROUP BY a.days";
		$res = $model -> query( $sql );
		return $res;
	}
}