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
		$this->repairOp();
	}

	/**
	 * 报警列表
	 */
	public function repairOp(){
        $url = C("admin_site_url") . "/modules/schedule/index.php" ;
        header( 'Location:' . $url );
	}
	
	

}
