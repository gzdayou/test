<?php
/**
 * 能源监测
 */

defined('ByAcesoft') or exit('Access Invalid!');
class real_consumControl extends SystemControl{
    private $links = array(
        array('url'=>'act=real_consum&op=save_energy', 'text' => '能耗节约'),
        array('url'=>'act=real_consum&op=save_co2', 'text' => '减排二氧化碳'),
        array('url'=>'act=real_consum&op=save_money', 'text' => '节省费用'),
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
    }

    public function indexOp() {
        $this->save_energyOp();
    }

    /**
     * 能耗节约
     */
    public function save_energyOp(){
        Tpl::output('top_link',$this->sublink($this->links,'save_energy'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_consum.save_energy');
    }

    /**
     * 减排二氧化碳
     */
    public function save_co2Op(){
        Tpl::output('top_link',$this->sublink($this->links,'save_co2'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_consum.save_co2');
    }
    
    /**
     * 节省费用
     */
    public function save_moneyOp(){
        Tpl::output('top_link',$this->sublink($this->links,'save_money'));
        Tpl::setDirquna('system');
        Tpl::showpage('real_consum.save_money');
    }
}
