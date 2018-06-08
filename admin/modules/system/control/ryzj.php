<?php
/**
 * 热源主机
 */

defined('ByAcesoft') or exit('Access Invalid!');
class ryzjControl extends SystemControl{
    private $links = array(
        array('url'=>'act=ryzj&op=base','lang'=>'web_set', 'text' => '手动运行'),
        array('url'=>'act=ryzj&op=dump','lang'=>'dis_dump', 'text' => '自动运行'),
        array('url'=>'act=ryzj&op=login','lang'=>'loginSettings', 'text' => '模式切换'),
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
    	//Tpl::output('top_link',$this->sublink($this->links,'index'));
    
    	//Tpl::setDirquna('system');
    	//Tpl::showpage('hot_master.base');
        $url = C("admin_site_url") . "/modules/system/index.php?act=lyzj" ;
        header( 'Location:' . $url );
    }
    
}
