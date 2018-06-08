<?php
/**
 * 模式切换
 */

defined('ByAcesoft') or exit('Access Invalid!');
class mod_changeControl extends SystemControl{
    private $links = array(
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 基本信息
     */
    public function baseOp(){
        Tpl::setDirquna('system');
        Tpl::showpage('mod_change.base');
    }
    
}
