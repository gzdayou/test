<?php
/**
 * 冷却塔
 */



defined('ByAcesoft') or exit('Access Invalid!');
class towerControl extends SystemControl{
    
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
        Tpl::showpage('tower.base');
    }
    
}
