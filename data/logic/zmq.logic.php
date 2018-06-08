<?php
/**
 * zmq交互处理
 */

class zmqLogic {

    public function __construct() {
        $this -> _zmq_addr = C("zmq_addr") ;
    }

    function getZmqData( $msgName ) {
        $context = new ZMQContext();
        $client = new ZMQSocket($context, ZMQ::SOCKET_DEALER);
        $client->connect( $this -> _zmq_addr );

        $data = '{"MSGOBJ": {"MsgType": "DATAOBJ","MsgName": "'.$msgName.'","MsgProp": "0","MsgValue": "0"}}';

        $client->send("", ZMQ::MODE_SNDMORE);
        $client->send("MDPC01", ZMQ::MODE_SNDMORE);
        $client->send(C("work_station") , ZMQ::MODE_SNDMORE);
        $client->send($data);

        $flag = true;
        $index = 0;
        while($flag) {
            $reply = $client->recv();
            $index ++ ;
            if( $index >= 4 ) {
                $flag = false;
            }
        }
        $client->disconnect( $this -> _zmq_addr );

        return $reply ;
    }

    function sendCtrl( $data ) {
        $context = new ZMQContext();
        $client = new ZMQSocket($context, ZMQ::SOCKET_DEALER);
        $client->connect( $this -> _zmq_addr );

        $client->send("", ZMQ::MODE_SNDMORE);
        $client->send("MDPC01", ZMQ::MODE_SNDMORE);
        $client->send(C("work_station"), ZMQ::MODE_SNDMORE);
        $client->send($data);

        $flag = true;
        $index = 0;
        while($flag) {
            $reply = $client->recv();
            $index ++ ;
            if( $index >= 4 ) {
                $flag = false;
            }
        }
        $client->disconnect( $this -> _zmq_addr );

        return $reply ;
    }

}
