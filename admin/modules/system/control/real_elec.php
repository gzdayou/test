<?php
/**
 * 实时电量
 */

defined('ByAcesoft') or exit('Access Invalid!');
class real_elecControl extends SystemControl{
    private $links = array(
        array('url'=>'act=real_elec&op=base', 'text' => '主机电量'),
        array('url'=>'act=real_elec&op=ldb_elec', 'text' => '冷冻泵电量'),
        array('url'=>'act=real_elec&op=lqb_elec', 'text' => '冷却泵电量'),
        array('url'=>'act=real_elec&op=rsb_elec', 'text' => '热水泵电量'),
    );
    public function __construct(){
        parent::__construct();
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 基本信息
     */
    public function baseOp(){
        Tpl::output('top_link',$this->sublink($this->links,'base'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.base');
    }

    /**
     * 冷冻泵实时电量
     */
    public function ldb_elecOp(){
        Tpl::output('top_link',$this->sublink($this->links,'ldb_elec'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.ldb');
    }
    
    /**
     * 冷却泵实时电量
     */
    public function lqb_elecOp(){
        Tpl::output('top_link',$this->sublink($this->links,'lqb_elec'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.lqb');
    }

    /**
     * 热水泵实时电量
     */
    public function rsb_elecOp(){
        Tpl::output('top_link',$this->sublink($this->links,'rsb_elec'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.rsb');
    }
}
