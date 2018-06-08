<?php
/**
 * 冷热源站
 */

defined('ByAcesoft') or exit('Access Invalid!');
class main_aceControl extends SystemControl{
    private $links = array(
        array('url'=>'act=main_ace&op=base', 'text' => '运行状态'),
        array('url'=>'act=main_ace&op=mod_change', 'text' => '参数设定'),
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 首页
     */
    public function baseOp(){

        /** @var zmqLogic $zmq */
        $zmq = Logic("zmq") ;
        $response = $zmq -> getZmqData( "ACEGUIState" ) ;
        $res = json_decode($response,true) ;
        $sysInfo = $res['MSGOBJ']['ACEGUIState']['SysInfo'][0];

        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'base'));
		
        Tpl::setDirquna('system');
        if( $sysInfo['SeasonMode'] == 1 ) {
            Tpl::showpage('main_ace.summer');
        } else {
            Tpl::showpage('main_ace.winter');
        }
    }

    /**
     * 参数设定
     */
    public function mod_changeOp() {
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'mod_change'));
        Tpl::setDirquna('system');
        Tpl::showpage('mod_change.base');
    }
    
}
