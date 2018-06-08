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
		$this->scheduleOp();
	}

	/**
	 * 报警列表
	 */
	public function scheduleOp(){
		Tpl::setDirquna('schedule');
		Tpl::showpage('schedule.index');
	}
	
	

}
