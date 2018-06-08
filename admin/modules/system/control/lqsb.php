<?php
/**
 * 冷却水泵
 */



defined('ByAcesoft') or exit('Access Invalid!');
class lqsbControl extends SystemControl{
    private $links = array(
        array('url'=>'act=lqsb&op=index', 'text' => '一号泵'),
        array('url'=>'act=lqsb&op=idx_two', 'text' => '二号泵'),
        array('url'=>'act=lqsb&op=idx_three', 'text' => '三号泵'),
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
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'index'));
		Tpl::output('idx', 0);
		Tpl::setDirquna('system');
        Tpl::showpage('lqsb.base');
    }

    public function idx_twoOp() {
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'idx_two'));
        Tpl::output('idx', 1);
        Tpl::setDirquna('system');
        Tpl::showpage('lqsb.base');
    }
    
    public function idx_threeOp() {
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'idx_three'));
        Tpl::output('idx', 2);
        Tpl::setDirquna('system');
        Tpl::showpage('lqsb.base');
    }

    
}
