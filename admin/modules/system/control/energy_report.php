<?php
/**
 * 能耗报表
 */

defined('ByAcesoft') or exit('Access Invalid!');
class energy_reportControl extends SystemControl{
    const PERPAGE = 22;
    private $links = array(
        array('url'=>'act=energy_report&op=base', 'text' => '系统组件耗能'),
        array('url'=>'act=energy_report&op=temperature', 'text' => '水温报表'),
        array('url'=>'act=energy_report&op=save_energy', 'text' => '节省与减排'),
    );
    public function __construct(){
        parent::__construct();
        //Language::read('setting');
    }

    public function indexOp() {
        if( $_GET['export'] == 1 ) {
            $data = $this -> _search_component($_GET['begin'], $_GET['end']);
            
            $this -> _export_component( $data ) ;
            exit;
        }
        $this->baseOp();
    }

    /**
     * 系统组件耗能页面展示
     */
    public function baseOp(){
        $end = date('Y-m-d');
        $begin = date("Y-m-d", strtotime("-1 month"));
        $data = $this -> _search_component($begin, $end);
        
        $list = array_values($data);
        $list = array_slice($list, 0, self::PERPAGE);

        Tpl::output('begin', $begin);
        Tpl::output('end', $end);
        Tpl::output('total', count($data));
        Tpl::output('limit', self::PERPAGE);
        Tpl::output('list', $list);
        Tpl::output('top_link',$this->sublink($this->links,'base'));
        Tpl::setDirquna('system');
        Tpl::showpage('energy_report.base');
    }

    /**
     * 系统组件耗能ajax数据获取
     */
    public function component_ajaxOp() {
        $page = $_GET['page'] ? $_GET['page'] : 1 ;
        $data = $this -> _search_component($_GET['begin'], $_GET['end']);
        $s = ($page - 1) * self::PERPAGE ;

        $list = array_values($data);
        $list = array_slice($list, $s, self::PERPAGE);

        $result = array();
        $result['status'] = 1;
        $result['data'] = $list ;
        $result['total'] = count($data);
        die( json_encode($result) );
    }

    /**
     * 组件能耗数据查询
     */
    private function _search_component( $begin, $end ) {
        $sub_sql = "SELECT *, LEFT(DeviceId, 2) AS d_type, MAX(`CurEnergy`) AS energy, DATE_FORMAT(RecordTime,'%Y-%m-%d') AS days, DATE_FORMAT(RecordTime,'%m月%d') AS day2  FROM `".DBPRE."devicerealtime` WHERE `RecordTime` > '". $begin ."' AND `RecordTime` < '".$end."' GROUP BY `RecordTime`, `DeviceID`";

        $model = Model();
		$condition = array();
		$sql = "SELECT a.ID,a.days,a.d_type, SUM(a.energy) as energy, a.day2 FROM (". $sub_sql ." ) AS a GROUP BY a.d_type, a.days ORDER BY days DESC";
        
        $res = $model -> query( $sql );
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

    /**
     * 组件能耗导出excel
     */
    private function _export_component( $data ) {
        vendor('PHPExcel');
        $objExcel = new \PHPExcel();
    	$objExcel->getActiveSheet ()->setTitle ( '系统组件耗能导出' );
    	$objExcel->getActiveSheet ()->mergeCells ( 'A1:G1' );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setSize ( 15 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setBold ( true );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'A' )->setWidth ( 22 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'B' )->setWidth ( 20 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'C' )->setWidth ( 15 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'D' )->setWidth ( 15 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'E' )->setWidth ( 25 );
        $objExcel->getActiveSheet ()->getColumnDimension ( 'F' )->setWidth ( 25 );
        $objExcel->getActiveSheet ()->getColumnDimension ( 'G' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'B2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'C2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'D2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'E2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
        $objExcel->getActiveSheet ()->getStyle ( 'F2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
        $objExcel->getActiveSheet ()->getStyle ( 'G2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	
    	$objWriter = \PHPExcel_IOFactory::createWriter ( $objExcel, 'Excel2007' );
    	$objActSheet = $objExcel->getActiveSheet ();
    	$key = ord ( "A" );
        $objActSheet->setCellValue ( "A1", '系统组件耗能' );
        $objActSheet->setCellValue ( "A2", '日期' );
    	$objActSheet->setCellValue ( "B2", '系统总耗能' );
    	$objActSheet->setCellValue ( "C2", '主机耗能' );
    	$objActSheet->setCellValue ( "D2", '冷冻泵耗能' );
    	$objActSheet->setCellValue ( "E2", '冷却泵耗能' );
    	$objActSheet->setCellValue ( "F2", '热水泵耗能' );
    	$objActSheet->setCellValue ( "G2", '冷却塔耗能' );
    	
    	// end set excel style
    	$k = 3;
    	foreach ( $data as $index => $row ) {
            $objActSheet->setCellValue ( "A" . $k, $row['day'] );
            $objActSheet->setCellValue ( "B" . $k, $row[10] + $row[20] + $row[30] + $row[40] + $row[50] );
            $objActSheet->setCellValue ( "C" . $k, $row[10] ?  $row[10] : 0);
            $objActSheet->setCellValue ( "D" . $k, $row[20] ?  $row[20] : 0 );
            $objActSheet->setCellValue ( "E" . $k, $row[30] ?  $row[30] : 0 );
            $objActSheet->setCellValue ( "F" . $k, $row[40] ?  $row[40] : 0 );
            $objActSheet->setCellValue ( "G" . $k, $row[50] ?  $row[50] : 0 );
            $k++;
    	}
    	// 输出excel信息
    	$outfile = '系统组件耗能' . date ( 'Y-m-d' ) . '.xlsx';
    	// export to exploer
    	header ( "Content-Type: application/force-download" );
    	header ( "Content-Type: application/octet-stream" );
    	header ( "Content-Type: application/download" );
    	header ( 'Content-Disposition:inline;filename="' . $outfile . '"' );
    	header ( "Content-Transfer-Encoding: binary" );
    	header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
    	header ( "Pragma: no-cache" );
    	$objWriter->save ( 'php://output' );
    	exit ();
    }

    /**
     * 水温报表页面展示
     */
    public function temperatureOp() {
        if( $_GET['export'] == 1 ) {
            $data = $this -> _search_temperature($_GET['day'], 1, true);
            
            $this -> _export_temperature( $data[1] ) ;
            exit;
        }
        
        $day = date('Y-m-d');//$day = '2018-01-24';
        $res = $this -> _search_temperature( $day, 1 );

        Tpl::output('day', $day);
        Tpl::output('total', $res[0]);
        Tpl::output('limit', self::PERPAGE);
        Tpl::output('list', $res[1]);
        Tpl::output('top_link',$this->sublink($this->links,'temperature'));
        Tpl::setDirquna('system');
        Tpl::showpage('energy_report.temperature');
    }

    /**
     * 水温报表数据搜索
     */
    private function _search_temperature( $day, $page = 1, $export = false ) {
        $model = Model();
        $condition = array();
        $condition['RecordTime'] = array('like', $day."%");
        $limit = ( $page - 1 ) * self::PERPAGE . "," . self::PERPAGE ;
        $total = $model->table('envrealtime')
                        ->field("RecordTime, T1, T2, T3, T4")
                        ->where($condition)
                        ->count();

        if ( $export ) $limit = 10000;

        $res = $model->table('envrealtime')
                    ->field("RecordTime, T1, T2, T3, T4")
                    ->where($condition)
                    ->order("RecordTime desc")
                    ->limit($limit)
                    ->select();
        
        return array($total, $res) ;
    }

    /**
     * 水温报表ajax数据获取
     */
    public function temperature_ajaxOp() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $res = $this -> _search_temperature($_GET['day'], $page);
        $result = array();
        $result['status'] = 1;
        $result['data'] = $res[1] ;
        $result['total'] = $res[0] ;
        die( json_encode($result) );
    }

    /**
     * 水温报表导出excel
     */
    private function _export_temperature( $data ) {
        vendor('PHPExcel');
        $objExcel = new \PHPExcel();
    	$objExcel->getActiveSheet ()->setTitle ( '水温报表导出' );
    	$objExcel->getActiveSheet ()->mergeCells ( 'A1:G1' );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setSize ( 15 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setBold ( true );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'A' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'B' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'C' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'D' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'E' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'B2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'C2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'D2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'E2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	
    	$objWriter = \PHPExcel_IOFactory::createWriter ( $objExcel, 'Excel2007' );
    	$objActSheet = $objExcel->getActiveSheet ();
    	$key = ord ( "A" );
        $objActSheet->setCellValue ( "A1", '水温报表' );
        $objActSheet->setCellValue ( "A2", '时间' );
    	$objActSheet->setCellValue ( "B2", '冷冻(热)供水温度' );
    	$objActSheet->setCellValue ( "C2", '冷冻(热)回水温度' );
    	$objActSheet->setCellValue ( "D2", '冷却水温度' );
    	$objActSheet->setCellValue ( "E2", '冷却水回水温度' );
    	
    	// end set excel style
    	$k = 3;
    	foreach ( $data as $index => $row ) {
            $objActSheet->setCellValue ( "A" . $k, $row['RecordTime'] );
            $objActSheet->setCellValue ( "B" . $k, $row['T1'] );
            $objActSheet->setCellValue ( "C" . $k, $row['T2'] );
            $objActSheet->setCellValue ( "D" . $k, $row['T3'] );
            $objActSheet->setCellValue ( "E" . $k, $row['T4'] );
            $k++;
    	}
    	// 输出excel信息
    	$outfile = '水温报表' . date ( 'Y-m-d' ) . '.xlsx';
    	// export to exploer
    	header ( "Content-Type: application/force-download" );
    	header ( "Content-Type: application/octet-stream" );
    	header ( "Content-Type: application/download" );
    	header ( 'Content-Disposition:inline;filename="' . $outfile . '"' );
    	header ( "Content-Transfer-Encoding: binary" );
    	header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
    	header ( "Pragma: no-cache" );
    	$objWriter->save ( 'php://output' );
    	exit ();
    }

    /**
     * 节省与减排
     */
    public function save_energyOp() {
        if( $_GET['export'] == 1 ) {
            $data = $this -> _search_save_energy($_GET['begin'], $_GET['end']);
            
            $this -> _export_save_energy( $data ) ;
            exit;
        }
        
        $end = date('Y-m-d');
        $begin = date("Y-m-d", strtotime("-1 month"));
        $list = $this -> _search_save_energy( $begin ,$end );

        Tpl::output('begin', $begin);
        Tpl::output('end', $end);
        Tpl::output('list', array_slice($list, 0, self::PERPAGE));
        Tpl::output('total', count($list));
        Tpl::output('limit', self::PERPAGE);
        Tpl::output('top_link',$this->sublink($this->links,'save_energy'));
        Tpl::setDirquna('system');
        Tpl::showpage('energy_report.saveenergy');
    }

    /**
     * 节省与减排数据搜索
     */
    private function _search_save_energy( $begin, $end ) {
        $model = Model();
        $res = $model->table('acedevenergy')
                    ->field("MAX(`DevTotalEnergy`) AS energy, DATE_FORMAT(`RecordDate`,'%Y-%m-%d') AS day")
                    ->where("`RecordDate` >= '" . $begin . "' AND `RecordDate` <= '". $end ."' ")
                    ->group("day")
                    ->order("day desc")
                    ->select();//echo $model->getLastSql();exit;
        
        $result = array() ;
        foreach ( $res as $key => $val ) {
            $result[$key]['day'] = $val['day'];
            $result[$key]['energy'] = $val['energy'];
            $result[$key]['save_energy'] = $val['energy'] * C('save_energy_ratio');
            $result[$key]['save_co2'] = $val['energy'] * C('save_co2_ratio');
            $result[$key]['save_money'] = $val['energy'] * C('save_money_ratio');
        }

        return $result ;
    }

    /**
     * 节省与减排ajax数据获取
     */
    public function save_energy_ajaxOp() {
        $data = $this -> _search_save_energy($_GET['begin'], $_GET['end']);
        $page = $_GET['page'];
        $s = ($page - 1) * self::PERPAGE ;

        $list = array_slice($data, $s, self::PERPAGE);
        $result = array();
        $result['status'] = 1;
        $result['data'] = $list ;
        die( json_encode($result) );
    }

    /**
     * 水温报表导出excel
     */
    private function _export_save_energy( $data ) {
        vendor('PHPExcel');
        $objExcel = new \PHPExcel();
    	$objExcel->getActiveSheet ()->setTitle ( '节省与减排' );
    	$objExcel->getActiveSheet ()->mergeCells ( 'A1:G1' );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setSize ( 15 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A1' )->getFont ()->setBold ( true );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'A' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'B' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'C' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getColumnDimension ( 'D' )->setWidth ( 25 );
    	$objExcel->getActiveSheet ()->getStyle ( 'A2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'B2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'C2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	$objExcel->getActiveSheet ()->getStyle ( 'D2' )->getAlignment ()->setHorizontal ( \PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
    	
    	$objWriter = \PHPExcel_IOFactory::createWriter ( $objExcel, 'Excel2007' );
    	$objActSheet = $objExcel->getActiveSheet ();
    	$key = ord ( "A" );
        $objActSheet->setCellValue ( "A1", '节省与减排' );
        $objActSheet->setCellValue ( "A2", '日期' );
    	$objActSheet->setCellValue ( "B2", '当前累计节省电量' );
    	$objActSheet->setCellValue ( "C2", '当前累计CO2减排量' );
    	$objActSheet->setCellValue ( "D2", '当前累计节省费用' );
    	
    	// end set excel style
    	$k = 3;
    	foreach ( $data as $index => $row ) {
            $objActSheet->setCellValue ( "A" . $k, $row['day'] );
            $objActSheet->setCellValue ( "B" . $k, $row['save_energy'] );
            $objActSheet->setCellValue ( "C" . $k, $row['save_co2'] );
            $objActSheet->setCellValue ( "D" . $k, $row['save_money'] );
            $k++;
    	}
    	// 输出excel信息
    	$outfile = '节省与减排' . date ( 'Y-m-d' ) . '.xlsx';
    	// export to exploer
    	header ( "Content-Type: application/force-download" );
    	header ( "Content-Type: application/octet-stream" );
    	header ( "Content-Type: application/download" );
    	header ( 'Content-Disposition:inline;filename="' . $outfile . '"' );
    	header ( "Content-Transfer-Encoding: binary" );
    	header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
    	header ( "Pragma: no-cache" );
    	$objWriter->save ( 'php://output' );
    	exit ();
    }
}
