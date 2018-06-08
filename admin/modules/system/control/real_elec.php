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
        array('url'=>'act=real_elec&op=tower_elec', 'text' => '冷却塔电量'),
    );
    public function __construct(){
        parent::__construct();
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 主机电量
     */
    public function baseOp(){
        $begin = date('Y-m-d');
        $end = date("Y-m-d",strtotime("+1 day")) ;
        
        $model = Model();
        $res = $model->table('hostrealtime')
                    ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%H:%i:%s') AS tm")
                    ->where("RecordTime >= '".$begin."' AND RecordTime <= '".$end."'")
                    ->group("d_type,tm")
                    ->select();

        Tpl::output('top_link',$this->sublink($this->links,'base'));
        Tpl::output('host', $res);
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.base');
    }

    /**
     * 冷冻泵实时电量
     */
    public function ldb_elecOp(){
        $begin = date('Y-m-d');
        $end = date("Y-m-d",strtotime("+1 day")) ;

        $model = Model();
        $res = $model->table('devicerealtime')
                    ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%H:%i:%s') AS tm")
                    ->where("RecordTime >= '".$begin."' AND RecordTime <= '".$end."' AND DeviceID > 200 AND DeviceID < 300")
                    ->group("d_type,tm")
                    ->select();

        Tpl::output('top_link',$this->sublink($this->links,'ldb_elec'));
        Tpl::output('host', $res);
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.ldb');
    }
    
    /**
     * 冷却泵实时电量
     */
    public function lqb_elecOp(){
        $begin = date('Y-m-d');
        $end = date("Y-m-d",strtotime("+1 day")) ;
        
        $model = Model();
        $res = $model->table('devicerealtime')
                    ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%H:%i:%s') AS tm")
                    ->where("RecordTime >= '".$begin."' AND RecordTime <= '".$end."' AND DeviceID > 300 AND DeviceID < 400")
                    ->group("d_type,tm")
                    ->select();

        Tpl::output('top_link',$this->sublink($this->links,'lqb_elec'));
        Tpl::output('host', $res);
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.lqb');
    }

    /**
     * 热水泵实时电量
     */
    public function rsb_elecOp(){
        $begin = date('Y-m-d');
        $end = date("Y-m-d",strtotime("+1 day")) ;
        
        $model = Model();
        $res = $model->table('devicerealtime')
                    ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%H:%i:%s') AS tm")
                    ->where("RecordTime >= '".$begin."' AND RecordTime <= '".$end."' AND DeviceID > 400 AND DeviceID < 500")
                    ->group("d_type,tm")
                    ->select();

        Tpl::output('top_link',$this->sublink($this->links,'rsb_elec'));
        Tpl::output('host', $res);
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.rsb');
    }

    /**
     * 冷却塔实时电量
     */
    public function tower_elecOp(){
        $begin = date('Y-m-d');
        $end = date("Y-m-d",strtotime("+1 day")) ;
        
        $model = Model();
        $res = $model->table('devicerealtime')
                    ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%H:%i:%s') AS tm")
                    ->where("RecordTime >= '".$begin."' AND RecordTime <= '".$end."' AND DeviceID > 500 AND DeviceID < 600")
                    ->group("d_type,tm")
                    ->select();

        Tpl::output('top_link',$this->sublink($this->links,'tower_elec'));
        Tpl::output('host', $res);
        Tpl::setDirquna('system');
        Tpl::showpage('real_elec.tower');
    }
}
