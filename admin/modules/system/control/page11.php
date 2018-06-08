<?php
/**
 * 阀门控制
 */



defined('ByAcesoft') or exit('Access Invalid!');
class page11Control extends SystemControl{
    private $links = array(
        array('url'=>'act=setting&op=base','lang'=>'web_set', 'text' => '手动运行'),
        array('url'=>'act=setting&op=dump','lang'=>'dis_dump', 'text' => '自动运行'),
        array('url'=>'act=setting&op=login','lang'=>'loginSettings', 'text' => '模式切换'),
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
        $url = C("admin_site_url") . "/modules/schedule/index.php" ;
        header( 'Location:' . $url );
    }


    
}
