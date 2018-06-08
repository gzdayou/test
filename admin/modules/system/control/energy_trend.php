<?php
/**
 * 能耗趋势
 */

defined('ByAcesoft') or exit('Access Invalid!');
class energy_trendControl extends SystemControl{
    private $links = array(
        //array('url'=>'act=energy_report&op=base', 'text' => '系统组件耗能'),
        // array('url'=>'act=energy_report&op=temperature', 'text' => '水温报表'),
        // array('url'=>'act=energy_report&op=save_energy', 'text' => '节省与减排'),
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
    }

    public function indexOp() {
        $this->baseOp();
    }

    /**
     * 能耗趋势页面展示
     */
    public function baseOp(){
        $end = date('Y-m-d');
        $begin = date("Y-m-d", strtotime("-1 month"));//$begin = '2018-01-01';
        $data = $this -> _search_component($begin, $end);
        $list = array_values($data);

        Tpl::output('begin', $begin);
        Tpl::output('end', $end);
        Tpl::output('list', $list);
        Tpl::output('top_link',$this->sublink($this->links,'base'));
        Tpl::setDirquna('system');
        Tpl::showpage('energy_trend.base');
    }

    /**
     * 能耗趋势ajax数据获取
     */
    public function component_ajaxOp() {
        $data = $this -> _search_component($_GET['begin'], $_GET['end']);
        $result = array();
        $result['status'] = 1;
        $result['data'] = array_values($data) ;
        die( json_encode($result) );
    }

    /**
     * 能耗趋势数据查询
     */
    private function _search_component( $begin, $end ) {
        $model = Model() ;
        $res = $model->table('acedevday')
                ->field("LEFT(`DeviceID`, 2) AS d_type, SUM(`DayEnergy`) AS energy, DATE_FORMAT(RecordDate,'%Y-%m-%d') AS days, DATE_FORMAT(RecordDate,'%m月%d') AS day2")
                ->where("RecordDate >= '".$begin."' AND RecordDate <= '".$end."'")
                ->group("d_type,days") ;
        $result = array();
        
        foreach ( $res as $value ) {
            $days = $value['days'];
            $d_type = $value['d_type'];
            $result[$days][$d_type] = round( $value['energy'], 2 ) ;
            $result[$days]['day'] = $days;
            $result[$days]['day2'] = $value['day2'];
        }
        
		return $result;
    }

}
