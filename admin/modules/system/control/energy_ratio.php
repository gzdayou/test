<?php
/**
 * 实时能效比
 */



defined('ByAcesoft') or exit('Access Invalid!');
class energy_ratioControl extends SystemControl{

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
        Tpl::showpage('energy_ratio.base');
    }


    
}
