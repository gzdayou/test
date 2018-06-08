<?php
/**
 * 能耗分析
 */

defined('ByAcesoft') or exit('Access Invalid!');
class energy_analysControl extends SystemControl{
    private $links = array(

    );

    private $_in_str = "(101,102,103,201,202,301,302,401,402,501)" ;

    public function __construct(){
        parent::__construct();
        Tpl::output('wdate', date('Y-m-d') );
        $wdate_day = date('Y-m-d') ;
        $wdate_day = '2018-03-16';
		Tpl::output('wdate_day', $wdate_day );
		Tpl::output('wdate_month', date('Y-m') );
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 能耗趋势页面展示
     */
    public function baseOp(){
        
        Tpl::setDirquna('system');
        Tpl::showpage('energy_analys.base');
    }

    /**
     * 获取数据ajax
     */
    public function ajax_dataOp() 
    {
        $model = Model() ;
        $data = array() ;
        //按日
        if( $_POST['type'] == 1 ) 
        {
            $energy_day = $this -> _energy_trend_day( $_POST['wdate'] ) ;
            $ot_day = $this -> _ot_trend_day( $_POST['wdate'] ) ;
            $energy_and_ot = array() ;
            for ( $i = 0 ; $i <= 23 ; $i ++ ) {
                $energy_and_ot[$i]['energy'] = isset( $energy_day[$i] ) ? round($energy_day[$i], 2) : 0 ;
                $energy_and_ot[$i]['ot'] = isset( $ot_day[$i] ) ? round($ot_day[$i], 2) : 0 ;
            }
            $data['energy_and_ot'] = $energy_and_ot ;

            //分项饼图
            $energy_pie_day = $this -> _energy_pie_day( $_POST['wdate'] ) ;
            $data['energy_pie'] = $energy_pie_day ;

            //分项用电趋势
            $res = $this -> _part_trend_day( $_POST['wdate'] ) ;
            $part_trend_day = array() ;
            for ( $i = 0 ; $i <= 23 ; $i ++ ) {
                $part_trend_day[$i]["10"] = isset( $res[$i]["10"] ) ? round($res[$i]["10"], 2) : 0 ;
                $part_trend_day[$i]["20"] = isset( $res[$i]["20"] ) ? round($res[$i]["20"], 2) : 0 ;
                $part_trend_day[$i]["30"] = isset( $res[$i]["30"] ) ? round($res[$i]["30"], 2) : 0 ;
                $part_trend_day[$i]["40"] = isset( $res[$i]["40"] ) ? round($res[$i]["40"], 2) : 0 ;
                $part_trend_day[$i]["50"] = isset( $res[$i]["50"] ) ? round($res[$i]["50"], 2) : 0 ;
            }
            $data['part_trend'] = $part_trend_day ;
        }

        //按月
        if( $_POST['type'] == 2 )
        {
            $energy_month = $this -> _energy_trend_month( $_POST['wdate'] ) ;
            $ot_month = $this -> _ot_trend_month( $_POST['wdate'] ) ;
            $energy_and_ot = array() ;
            $max_day = date('t', strtotime( $_POST['wdate'] . "-1") ) ;
            if( date('Y-m') == $_POST['wdate'] ) $max_day = date('d') ;
            for ( $i = 1 ; $i <= $max_day ; $i ++ ) {
                $energy_and_ot[$i]['energy'] = isset( $energy_month[$i] ) ? round($energy_month[$i], 2) : 0 ;
                $energy_and_ot[$i]['ot'] = isset( $ot_month[$i] ) ? round($ot_month[$i], 2) : 0 ;
            }
            $data['energy_and_ot'] = $energy_and_ot ;

            //分项饼图
            $energy_pie_month = $this -> _energy_pie_month( $_POST['wdate'] ) ;
            $data['energy_pie'] = $energy_pie_month ;

            //分项用电趋势
            $res = $this -> _part_trend_month( $_POST['wdate'] ) ;
            $part_trend_month = array() ;
            for ( $i = 1 ; $i <= $max_day ; $i ++ ) {
                $part_trend_month[$i]["10"] = isset( $res[$i]["10"] ) ? round($res[$i]["10"], 2) : 0 ;
                $part_trend_month[$i]["20"] = isset( $res[$i]["20"] ) ? round($res[$i]["20"], 2) : 0 ;
                $part_trend_month[$i]["30"] = isset( $res[$i]["30"] ) ? round($res[$i]["30"], 2) : 0 ;
                $part_trend_month[$i]["40"] = isset( $res[$i]["40"] ) ? round($res[$i]["40"], 2) : 0 ;
                $part_trend_month[$i]["50"] = isset( $res[$i]["50"] ) ? round($res[$i]["50"], 2) : 0 ;
            }
            $data['part_trend'] = $part_trend_month ;
        }

        $return = array() ;
        $return['status'] = 1;
        $return['data'] = $data ;

        die( json_encode($return) ) ;
    }

    /**
     * 按日用电总趋势
     */
    private function _energy_trend_day( $wdate ) 
    {
        $model = Model() ;
        $sql = "SELECT SUM(a.useEnergy) as useEnergy, `hour` FROM (
            SELECT `DeviceID`, DATE_FORMAT(RecordTime,'%k') AS `hour`, (MAX(`CurEnergy`) - MIN(`CurEnergy`)) AS useEnergy FROM `t_devicerealtime` WHERE `RecordTime` LIKE '".$wdate."%' AND `DeviceID` IN ". $this -> _in_str ."
            GROUP BY `DeviceID`, `hour`
            ) AS a GROUP BY a.hour";
        $result = $model->query( $sql ) ;
        
        $energy_day = array() ;
        if( is_array($result) && !empty($result) ) {
            $energy_day = array_column($result, 'useEnergy', 'hour' ) ;
        }

        return $energy_day ;
    }

    /**
     * 按日温度趋势
     */
    private function _ot_trend_day( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT DATE_FORMAT(RecordTime,'%k') AS `hour`, AVG(`OT`) AS ot FROM `t_envrealtime` WHERE `RecordTime` LIKE '".$wdate."%' GROUP BY `hour`";
        $result = $model->query( $sql ) ;

        $ot_day = array() ;
        if( is_array($result) && !empty($result) ) {
            $ot_day = array_column($result, 'ot', 'hour' ) ;
        }

        return $ot_day ;
    }

    /**
     * 按月用电总趋势
     */
    private function _energy_trend_month( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT DATE_FORMAT(RecordDate,'%d') AS `day`, SUM(`DayEnergy`) as useEnergy FROM `t_acedevday` WHERE `RecordDate` LIKE '".$wdate."%' AND `DeviceID` IN ". $this -> _in_str ." GROUP BY `day`";
        $result = $model->query( $sql ) ;
        
        $energy_month = array() ;
        if( is_array($result) && !empty($result) ) {
            $energy_month = array_column($result, 'useEnergy', 'day' ) ;
        }

        return $energy_month ;
    }

    /**
     * 按月室外温度趋势
     */
    private function _ot_trend_month( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT DATE_FORMAT(a.RecordTime,'%d') AS `day`, AVG(a.OT) AS ot FROM (
            SELECT *,DATE_FORMAT(RecordTime,'%k') AS `hour` FROM `t_envrealtime` WHERE RecordTime LIKE '".$wdate."%' AND OT > -20 AND OT < 50
        ) AS a WHERE a.hour >= 11 AND a.hour <= 13 GROUP BY `day`" ;
        $result = $model->query( $sql ) ;

        $ot_month = array() ;
        if( is_array($result) && !empty($result) ) {
            $ot_month = array_column($result, 'ot', 'day' ) ;
        }

        return $ot_month ;
    }

    /**
     * 日分项用电比例
     */
    private function _energy_pie_day( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT SUBSTRING(a.`DeviceID`, 1,2) AS device, SUM(a.CurEnergy) as energy FROM (
            SELECT `DeviceID`, MAX(`CurEnergy`) AS CurEnergy FROM `t_devicerealtime` WHERE `RecordTime` LIKE '".$wdate."%' 
            AND `DeviceID` IN ". $this -> _in_str ."
            GROUP BY `DeviceID`
            ) AS a GROUP BY device" ;
        $result = $model->query( $sql ) ;

        $pie_day = array() ;
        if( is_array($result) && !empty($result) ) {
            $pie_day = array_column($result, 'energy', 'device' ) ;
        }

        return $pie_day ;
    }

    /**
     * 月份向用电比例
     */
    private function _energy_pie_month( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT SUBSTRING(`DeviceID`, 1,2) AS device, SUM(`DayEnergy`) as energy FROM `t_acedevday` 
            WHERE `RecordDate` LIKE '".$wdate."%'  AND `DeviceID` IN ". $this -> _in_str ." GROUP BY device";
        $result = $model->query( $sql ) ;

        $pie_month = array() ;
        if( is_array($result) && !empty($result) ) {
            $pie_month = array_column($result, 'energy', 'device' ) ;
        }

        return $pie_month ;
    }

    /**
     * 日分项用电趋势
     */
    private function _part_trend_day( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT SUM(a.CurEnergy) as energy, SUBSTRING(a.`DeviceID`, 1,2) AS device, a.hour FROM (
            SELECT (MAX(`CurEnergy`) - MIN(`CurEnergy`)) AS CurEnergy, DATE_FORMAT(RecordTime,'%k') AS `hour`, `DeviceID` FROM `t_devicerealtime` 
            WHERE `RecordTime` LIKE '".$wdate."%' AND `DeviceID` IN ". $this -> _in_str ."
            GROUP BY `hour`, `DeviceID`
            ) AS a GROUP BY device, `hour`";
        $result = $model->query( $sql ) ;
        
        $part_trend_day = array() ;
        if( is_array($result) && !empty($result) ) {
            foreach ( $result as $row ) {
                $part_trend_day[ $row['hour'] ][ $row['device'] ] = $row['energy'] ;
            }
        }
        
        return $part_trend_day ;
    }

    /**
     * 月分项用电趋势
     */
    private function _part_trend_month( $wdate )
    {
        $model = Model() ;
        $sql = "SELECT SUBSTRING(`DeviceID`, 1,2) AS device, SUM(`DayEnergy`) AS energy, DATE_FORMAT(RecordDate,'%d') AS `day` FROM `t_acedevday` 
                WHERE `RecordDate` LIKE '".$wdate."%' AND `DeviceID` IN ". $this -> _in_str ."
                GROUP BY device, `day`";
        $result = $model->query( $sql ) ;

        $part_trend_month = array() ;
        if( is_array($result) && !empty($result) ) {
            foreach ( $result as $row ) {
                $part_trend_month[ $row['day'] ][ $row['device'] ] = $row['energy'] ;
            }
        }
        
        return $part_trend_month ;
    }
}
