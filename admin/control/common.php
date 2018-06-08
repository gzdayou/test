<?php
/**
 * 通用方法页面
 */

defined('ByAcesoft') or exit('Access Invalid!');

class commonControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        $this -> _vavel = C("vavel") ;
    }

    /**
     * 获取zmq数据
     */
    public function getMsgObjectOp()
    {
        $msg_name = $_GET['msg_name'] ;

        /** @var zmqLogic $zmq */
        $zmq = Logic("zmq") ;
        $response = $zmq -> getZmqData( $msg_name ) ;
        $res = json_decode($response,true) ;

        if( is_array($res) ) {
            $return['status'] = "1";
            $return['data'] = $res ;
        } else {
            $return['status'] = "0";
            $return['data'] = "" ;
        }

        die( json_encode($return) ) ;
    }

    // /**
    //  * 发送控制命令
    //  */
    // public function ctrlcmdOp() {
    //     $msg_name = $_GET['msg_name'] ;
    //     $msg_value = $_GET['msg_value'] ;
    //     $msg = '{"MSGOBJ": {"MsgType": "CTRLCMD","MsgName": "'. $msg_name .'","MsgProp": "18","MsgValue": "'. $msg_value .'"}}';
    //     /** @var zmqLogic $zmq */
    //     $zmq = Logic("zmq") ;
    //     $response = $zmq -> sendCtrl( $msg ) ;

    //     /** 记录操作日志 */
    //     $_command = $this -> _command();
    //     $content = $_command[$msg_name][$msg_value] ? $_command[$msg_name][$msg_value] : "未定义的操作";
    //     $log = array() ;
    //     $log['content'] = $content ;
    //     $log['createtime'] = time();
    //     $log['admin_name'] = $this->admin_info['name'];
    //     $log['admin_id'] = $this->admin_info['id'];
    //     $log['ip'] = $this->admin_info['ip'];
    //     $log['url'] = 'common&ctrlcmd';
    //     Model('admin_log')->insert($log);
        
    //     if( $response == 'CTRLCMD' ) {
    //         $result = array('status' => 1, 'msg' => '');
    //     } else {
    //         $result = array('status' => 0, 'msg' => '');
    //     }

    //     die( json_encode($result) ) ;
    // }

    // /**
    //  * 实时能效比数据获取
    //  */
    // public function getCurStateOp() {
    //     /** @var zmqLogic $zmq */
    //     $zmq = Logic("zmq") ;
    //     $response = $zmq -> getZmqData( "SystemState" ) ;
    //     $res = json_decode($response,true) ;
    //     $SystemState = $res['MSGOBJ']['SystemState'][0];
    //     $response = $zmq -> getZmqData( "EnvState" ) ;
    //     $res = json_decode($response,true) ;
    //     $EnvState = $res['MSGOBJ']['EnvState'][0];

    //     $result = array();
    //     $result['SystemState'] = $SystemState;
    //     $result['EnvState'] = $EnvState;

    //     die( json_encode($result) ) ;
    // }

    // private function _command() {
    //     return array(
    //         'SWITCH_HOST1' => array(
    //             '1' => '运行主机1', '0' => '停止主机1'
    //         ),
    //         'SWITCH_HOST2' => array(
    //             '1' => '运行主机2', '0' => '停止主机2'
    //         ),
    //         'SWITCH_HOST3' => array(
    //             '1' => '运行主机3', '0' => '停止主机3'
    //         ),
    //         'SWITCH_LDB1' => array(
    //             '1' => '运行冷冻泵1', '0' => '停止冷冻泵1'
    //         ),
    //         'SWITCH_LDB2' => array(
    //             '1' => '运行冷冻泵2', '0' => '停止冷冻泵2'
    //         ),
    //         'SWITCH_LDB3' => array(
    //             '1' => '运行冷冻泵3', '0' => '停止冷冻泵3'
    //         ),
    //         'SWITCH_LQB1' => array(
    //             '1' => '运行冷却泵1', '0' => '停止冷却泵1'
    //         ),
    //         'SWITCH_LQB2' => array(
    //             '1' => '运行冷却泵2', '0' => '停止冷却泵2'
    //         ),
    //         'SWITCH_LQB3' => array(
    //             '1' => '运行冷却泵3', '0' => '停止冷却泵3'
    //         ),
    //         'SWITCH_RSB1' => array(
    //             '1' => '运行热水泵1', '0' => '停止热水泵1'
    //         ),
    //         'SWITCH_RSB2' => array(
    //             '1' => '运行热水泵2', '0' => '停止热水泵2'
    //         ),
    //         'SWITCH_RSB3' => array(
    //             '1' => '运行热水泵3', '0' => '停止热水泵3'
    //         ),
    //         'SWITCH_LQT1' => array(
    //             '1' => '运行冷却塔1', '0' => '停止冷却塔1'
    //         ),
    //         'SWITCH_LQT2' => array(
    //             '1' => '运行冷却塔2', '0' => '停止冷却塔2'
    //         ),
    //         'SWITCH_LQT3' => array(
    //             '1' => '运行冷却塔3', '0' => '停止冷却塔3'
    //         ),
    //         'SWITCH_ESS1-1' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][0], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][0]
    //         ),
    //         'SWITCH_ESS1-2' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][1], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][1]
    //         ),
    //         'SWITCH_ESS1-3' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][2], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][2]
    //         ),
    //         'SWITCH_ESS1-4' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][3], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][3]
    //         ),
    //         'SWITCH_ESS1-5' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][4], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][4]
    //         ),
    //         'SWITCH_ESS1-6' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][5], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][5]
    //         ),
    //         'SWITCH_ESS1-7' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][6], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][6]
    //         ),
    //         'SWITCH_ESS1-8' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][7], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][7]
    //         ),
    //         'SWITCH_ESS1-9' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][8], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][8]
    //         ),
    //         'SWITCH_ESS1-10' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][9], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][9]
    //         ),
    //         'SWITCH_ESS1-11' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][10], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][10]
    //         ),
    //         'SWITCH_ESS1-12' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][11], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][11]
    //         ),
    //         'SWITCH_ESS1-13' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][12], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][12]
    //         ),
    //         'SWITCH_ESS1-14' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][13], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][13]
    //         ),
    //         'SWITCH_ESS1-15' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][14], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][14]
    //         ),
    //         'SWITCH_ESS1-16' => array(
    //             '1' => '打开' . $this -> _vavel['SWITCH_ESS1-'][15], '0' => '关闭' . $this -> _vavel['SWITCH_ESS1-'][15]
    //         ),
    //     ) ;
    // }
}
