<?php
/**
 * 设备控制
 */



defined('ByAcesoft') or exit('Access Invalid!');
class device_controlControl extends SystemControl{
    private $links = array(
        array('url'=>'act=setting&op=base','lang'=>'web_set', 'text' => '手动运行'),
        array('url'=>'act=setting&op=dump','lang'=>'dis_dump', 'text' => '自动运行'),
        array('url'=>'act=setting&op=login','lang'=>'loginSettings', 'text' => '模式切换'),
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
        $this -> _vavel = C("vavel") ;
    }

    public function indexOp() {
        die( json_encode( array('status' => 1, 'msg' => '') ) ) ;
    }

    /**
     * 发送控制命令
     */
    public function ctrlcmdOp() {
        $msg_name = $_GET['msg_name'] ;
        $msg_value = $_GET['msg_value'] ;
        $msg = '{"MSGOBJ": {"MsgType": "CTRLCMD","MsgName": "'. $msg_name .'","MsgProp": "18","MsgValue": "'. $msg_value .'"}}';
        /** @var zmqLogic $zmq */
        $zmq = Logic("zmq") ;
        $response = $zmq -> sendCtrl( $msg ) ;

        /** 记录操作日志 */
        $_command = $this -> _command();
        $content = $_command[$msg_name][$msg_value] ? $_command[$msg_name][$msg_value] : "未定义的操作";
        // $log = array() ;
        // $log['content'] = $content ;
        // $log['createtime'] = time();
        // $log['admin_name'] = $this->admin_info['name'];
        // $log['admin_id'] = $this->admin_info['id'];
        // $log['ip'] = $this->admin_info['ip'];
        // $log['url'] = 'common&ctrlcmd';
        // Model('admin_log')->insert($log);
        $log = array() ;
        $log['RecordTime'] = date('Y-m-d H:i:s') ;
        $log['UserID'] = $this->admin_info['id'];
        $log['DeviceID'] = $_command[$msg_name]["device"] ? $_command[$msg_name]["device"] : 0;
        $log['OperationType'] = $msg_value ;
        $log['OperationInfo'] = $content ;
        Model('log_operation')->insert($log);
        
        if( $response == 'CTRLCMD' ) {
            $result = array('status' => 1, 'msg' => '');
        } else {
            $result = array('status' => 0, 'msg' => '');
        }

        die( json_encode($result) ) ;
    }

    private function _command() {
        return array(
            'SWITCH_HOST1' => array(
                '1' => '运行主机1', '2' => '停止主机1', 'device' => 101
            ),
            'SWITCH_HOST2' => array(
                '1' => '运行主机2', '2' => '停止主机2', 'device' => 102
            ),
            'SWITCH_HOST3' => array(
                '1' => '运行主机3', '2' => '停止主机3', 'device' => 103
            ),
            'SWITCH_LDB1' => array(
                '1' => '运行冷冻泵1', '2' => '停止冷冻泵1', 'device' => 201
            ),
            'SWITCH_LDB2' => array(
                '1' => '运行冷冻泵2', '2' => '停止冷冻泵2', 'device' => 202
            ),
            'SWITCH_LDB3' => array(
                '1' => '运行冷冻泵3', '2' => '停止冷冻泵3', 'device' => 203
            ),
            'SWITCH_LQB1' => array(
                '1' => '运行冷却泵1', '2' => '停止冷却泵1', 'device' => 301
            ),
            'SWITCH_LQB2' => array(
                '1' => '运行冷却泵2', '2' => '停止冷却泵2', 'device' => 302
            ),
            'SWITCH_LQB3' => array(
                '1' => '运行冷却泵3', '2' => '停止冷却泵3', 'device' => 303
            ),
            'SWITCH_RSB1' => array(
                '1' => '运行热水泵1', '2' => '停止热水泵1', 'device' => 401
            ),
            'SWITCH_RSB2' => array(
                '1' => '运行热水泵2', '2' => '停止热水泵2', 'device' => 402
            ),
            'SWITCH_RSB3' => array(
                '1' => '运行热水泵3', '2' => '停止热水泵3', 'device' => 403
            ),
            'SWITCH_LQT1-1' => array(
                '1' => '运行冷却塔1', '2' => '停止冷却塔1', 'device' => 501
            ),
            'SWITCH_LQT1-2' => array(
                '1' => '运行冷却塔2', '2' => '停止冷却塔2', 'device' => 502
            ),
            'SWITCH_LQT1-3' => array(
                '1' => '运行冷却塔3', '2' => '停止冷却塔3', 'device' => 503
            ),
            'SWITCH_ESS1-1' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][0], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][0], 'device' => 601
            ),
            'SWITCH_ESS1-2' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][1], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][1], 'device' => 602
            ),
            'SWITCH_ESS1-3' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][2], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][2], 'device' => 603
            ),
            'SWITCH_ESS1-4' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][3], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][3], 'device' => 604
            ),
            'SWITCH_ESS1-5' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][4], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][4], 'device' => 605
            ),
            'SWITCH_ESS1-6' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][5], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][5], 'device' => 606
            ),
            'SWITCH_ESS1-7' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][6], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][6], 'device' => 607
            ),
            'SWITCH_ESS1-8' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][7], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][7], 'device' => 608
            ),
            'SWITCH_ESS1-9' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][8], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][8], 'device' => 609
            ),
            'SWITCH_ESS1-10' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][9], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][9], 'device' => 610
            ),
            'SWITCH_ESS1-11' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][10], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][10], 'device' => 611
            ),
            'SWITCH_ESS1-12' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][11], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][11], 'device' => 612
            ),
            'SWITCH_ESS1-13' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][12], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][12], 'device' => 613
            ),
            'SWITCH_ESS1-14' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][13], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][13], 'device' => 614
            ),
            'SWITCH_ESS1-15' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][14], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][14], 'device' => 615
            ),
            'SWITCH_ESS1-16' => array(
                '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][15], '2' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][15], 'device' => 616
            ),
        ) ;
    }
    
}
