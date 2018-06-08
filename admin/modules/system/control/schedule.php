<?php
/**
 * 日程策略
 */



defined('ByAcesoft') or exit('Access Invalid!');
class scheduleControl extends SystemControl{
    private $links = array(
        array('url'=>'act=schedule&op=base', 'text' => '模板设置'),
        array('url'=>'act=schedule&op=timeline', 'text' => '时间轴设置')
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
        $list = Model('models')->select();
        $code_list = $this -> _getDeviceListOfCode() ;
        $lines = count($list) < 6 ? 15 : 13;
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'base'));
        Tpl::output('models_list', $list);
        Tpl::output('code_list', $code_list);
        Tpl::output('lines', $lines);
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.base');
    }

    /**
     * 新增模板
     */
    public function add_templateOp() {
        $list = $this -> _getDeviceList() ;
        
        Tpl::output('device_list',$list);
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.addtemplate');
    }

    public function add_template_ajaxOp() {
        //var_dump($_POST);
        $save_data = array();
        $save_data['Name'] = $_POST['model_name'];
        $save_data['HOST'] = isset($_POST['HOST']) ? implode(",", $_POST['HOST']) : "";
        $save_data['LDB'] = isset($_POST['LDB']) ? implode(",", $_POST['LDB']) : "";
        $save_data['LQB'] = isset($_POST['LQB']) ? implode(",", $_POST['LQB']) : "";
        $save_data['RSB'] = isset($_POST['RSB']) ? implode(",", $_POST['RSB']) : "";
        $save_data['LQT'] = isset($_POST['LQT']) ? implode(",", $_POST['LQT']) : "";
        $save_data['FM'] = isset($_POST['FM']) ? implode(",", $_POST['FM']) : "";
        if( Model('models')->insert($save_data) ) {
            die( json_encode(array('status' => 1)) ) ;
        }

        die( json_encode(array('status' => 0)) ) ;
    }

    public function del_template_ajaxOp() {
        if( !intval($_POST['id']) ) die( json_encode(array('status' => 0, 'msg' => '没有ID')) ) ;

        if( !$this -> _check_template_used( intval($_POST['id']) ) ) die( json_encode(array('status' => 0, 'msg' => '该模式已在时间轴使用，无法删除')) ) ;

        if( Model('models')->where(array('ModelId'=> intval($_POST['id']) ))->delete() ) {
            die( json_encode(array('status' => 1)) ) ;
        }
        
        die( json_encode(array('status' => 0)) ) ;
    }

    private function _check_template_used( $modelid ) {
        $flag = true ;
        $model_off = $modelid << 8 ;
        $model_on = $model_off + 1 ;
        $where = "" ;
        for ( $i = 1; $i <= 48; $i++ ) {
            $colm = "time" . $i ;
            if( $i == 1 ) {
                $where .= "$colm IN ($model_off, $model_on)" ;
            } else {
                $where .= " OR $colm IN ($model_off, $model_on)" ;
            }
        }
        $res = Model('timeline_detail')->where($where)->select() ;
        if( is_array($res) && !empty($res) ) $flag = false ;

        return $flag ;
    }

    public function edit_templateOp() {
        $list = $this -> _getDeviceList() ;
        $id = intval($_GET['id']);
        $model_detail = Model('models') -> where( array('ModelId' => $id) ) -> find();
        
        Tpl::output('device_list',$list);
        Tpl::output('model_detail',$model_detail);
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.edittemplate');
    }

    public function edit_template_ajaxOp() {
        if( !intval($_POST['id']) ) die( json_encode(array('status' => 0)) ) ;

        $save_data = array();
        $save_data['Name'] = $_POST['model_name'];
        $save_data['HOST'] = isset($_POST['HOST']) ? implode(",", $_POST['HOST']) : "";
        $save_data['LDB'] = isset($_POST['LDB']) ? implode(",", $_POST['LDB']) : "";
        $save_data['LQB'] = isset($_POST['LQB']) ? implode(",", $_POST['LQB']) : "";
        $save_data['RSB'] = isset($_POST['RSB']) ? implode(",", $_POST['RSB']) : "";
        $save_data['LQT'] = isset($_POST['LQT']) ? implode(",", $_POST['LQT']) : "";
        $save_data['FM'] = isset($_POST['FM']) ? implode(",", $_POST['FM']) : "";
        if( Model('models')->where(array('ModelId'=> intval($_POST['id']) ))->update( $save_data ) ) {
            die( json_encode(array('status' => 1)) ) ;
        }
        
        die( json_encode(array('status' => 0)) ) ;
    }

    /**
     * 设备分组列表
     */
    private function _getDeviceList() {
        $model = Model();
        $condition = array();
        $condition['IsValid'] = 1;
        $res = $model->table('devices') -> where($condition) -> select();
        
        $list = array() ;
        foreach ( $res as $val ) {
            $tagname = $val['TagName'] ;
            if( $tagname == '' ) continue ;

            preg_match("/[A-Z]+/", $tagname, $matches);
            $list[$matches[0]][] = $val;
        }

        return $list;
    }

    /**
     * 设备编码列表
     */
    private function _getDeviceListOfCode() {
        $list = Model('devices') -> where( array('IsValid' => 1) ) -> select();
        return array_column( $list, 'DeviceName', 'TagName' );
    }

    /**
     * 基本信息
     */
    public function timelineOp(){
        $models = Model('models') -> select();
        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links,'timeline'));
        //时间轴列表
        Tpl::output('timeline_list', $this -> _GetTimelineList() );
        Tpl::output('models', array_column($models, 'Name', 'ModelId') );
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.timeline');
    }

    /**
     * 时间轴列表
     */
    private function _GetTimelineList() {
        $model = Model();
        $field = 'timeline.*,timeline_detail.*';
        $on = 'timeline.details_id = timeline_detail.details_id';
        $model->table('timeline,timeline_detail') -> field( $field );
        $list = $model->join('left')->on($on) -> order("timeline.id DESC")->select(); 

        return $list ;
    }

    /**
     * 添加时间轴
     */
    public function add_timelineOp() {
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.addtimeline', 'null_layout');
    }

    /**
     * 编辑时间轴
     */
    public function edit_timelineOp() {
        $model = Model();
        $field = 'timeline.*,timeline_detail.*';
        $on = 'timeline.details_id = timeline_detail.details_id';
        $model->table('timeline,timeline_detail') -> field( $field );
        $timeline = $model->join('left')->on($on)->where( array('timeline.details_id' => intval($_GET['id'])) )->find();

        $models = Model('models') -> select();

        Tpl::output('timeline', $timeline);
        Tpl::output('models', array_column($models, 'Name', 'ModelId') );
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.edittimeline', 'null_layout');
    }

    /**
     * 添加时间轴明细页面展示
     */
    public function add_timeline_detailOp() {
        $list = Model('models')->select();

        Tpl::output('models_list', $list);
        Tpl::setDirquna('system');
        Tpl::showpage('schedule.addtimeline_detail');
    }

    /**
     * 添加时间轴操作
     */
    public function addtimeline_ajaxOp() {

        if( !$this -> _check_timeline_priority( $_POST['begin'], $_POST['end'], $_POST['prio'] ) ) {
            $return = array( 'status' => 0, 'msg' => "时间段内优先级冲突" ) ;
            die( json_encode($return) ) ;
        }
        
        try {

            $model = Model('timeline_detail');
            $model->beginTransaction();
            $save_data = array() ;
            for ( $i = 1; $i <= 48; $i++ ) {
                $time_key = "time" . $i ;
                $model_key = $time_key . "_modelid" ;
                $turn_key = $time_key . "_modelturn" ;
                $save_data[ $time_key ] = ( intval($_POST[ $model_key ]) << 8 ) + intval($_POST[ $turn_key ]) ;
            }
            $detail_id = $model->insert( $save_data ) ;
            if ( !$detail_id ) {
                throw new Exception('明细表保存失败');
            }

            $save_data = array() ;
            $save_data['name'] = $_POST['timeline_name'] ;
            $save_data['details_id'] = $detail_id ;
            $save_data['starttime'] = $_POST['begin'] ;
            $save_data['endtime'] = $_POST['end'] ;
            $save_data['priority'] = $_POST['prio'] ;
            $save_data['datetype'] = $_POST['types'] ;
            $save_data['active'] = $_POST['active'] ;
            if( !Model('timeline')->insert( $save_data ) ) {
                throw new Exception('时间轴表保存失败');
            }

            $model -> commit() ;

        } catch (Exception $e){
            $model -> rollback() ;
            $return = array( 'status' => 0, 'msg' => $e->getMessage() ) ;
            die( json_encode($return) ) ;
        }

        $return = array( 'status' => 1, 'msg' => '保存成功' ) ;
        die( json_encode($return) ) ;

    }

    /**
     * 编辑时间轴操作
     */
    public function edittimeline_ajaxOp() {

        if( !$this -> _check_timeline_priority( $_POST['begin'], $_POST['end'], $_POST['prio'], intval($_POST['details_id'])  ) ) {
            $return = array( 'status' => 0, 'msg' => "时间段内优先级冲突" ) ;
            die( json_encode($return) ) ;
        }

        try {

            $model = Model('timeline_detail');
            $model->beginTransaction();

            $updt_data = array() ;
            $where = array('details_id' => intval($_POST['details_id']) ) ;
            for ( $i = 1; $i <= 48; $i++ ) {
                $time_key = "time" . $i ;
                $model_key = $time_key . "_modelid" ;
                $turn_key = $time_key . "_modelturn" ;
                $updt_data[ $time_key ] = ( intval($_POST[ $model_key ]) << 8 ) + intval($_POST[ $turn_key ]) ;
            }
            $status = $model -> where( $where ) -> update( $updt_data ) ;
            if ( !$status ) {
                throw new Exception('明细表更新失败');
            }

            $updt_data = array() ;
            $updt_data['name'] = $_POST['timeline_name'] ;
            //$updt_data['details_id'] = $detail_id ;
            $updt_data['starttime'] = $_POST['begin'] ;
            $updt_data['endtime'] = $_POST['end'] ;
            $updt_data['priority'] = $_POST['prio'] ;
            $updt_data['datetype'] = $_POST['types'] ;
            $updt_data['active'] = $_POST['active'] ;
            if( !Model('timeline')  -> where( $where ) -> update( $updt_data ) ) {
                throw new Exception('时间轴表更新失败');
            }

            $model -> commit() ;

        } catch ( Exception $e ){
            $model -> rollback() ;
            $return = array( 'status' => 0, 'msg' => $e->getMessage() ) ;
            die( json_encode($return) ) ;
        }

        $return = array( 'status' => 1, 'msg' => '更新成功' ) ;
        die( json_encode($return) ) ;
    }

    /**
     * 删除时间轴操作
     */
    public function del_timeline_ajaxOp() {
        $id = intval($_POST['id']) ;
        if( !$id ) {
            $return = array('status' => 0, 'msg' => 'ID异常') ;
            die( json_encode($return) ) ;
        }

        try {

            $model = Model('timeline_detail');
            $model->beginTransaction();

            $where = array() ;
            $where['details_id'] = $id ;
            $status = $model -> where( $where ) -> delete() ;
            if ( !$status ) {
                throw new Exception('明细表删除失败');
            }

            if( !Model('timeline')  -> where( $where ) -> delete() ) {
                throw new Exception('时间轴表删除失败');
            }

            $model -> commit() ;

        } catch ( Exception $e ){
            $model -> rollback() ;
            $return = array( 'status' => 0, 'msg' => $e->getMessage() ) ;
            die( json_encode($return) ) ;
        }

        $return = array( 'status' => 1, 'msg' => '删除成功' ) ;
        die( json_encode($return) ) ;
    }

    /**
     * 激活时间轴
     */
    public function active_timeline_ajaxOp() {
        $id = intval($_POST['id']) ;
        if( !$id ) {
            $return = array('status' => 0, 'msg' => 'ID异常') ;
            die( json_encode($return) ) ;
        }

        $model = Model() ;
        $data = array() ;
        $data['active'] = 1 ;
        $status = $model -> table( 'timeline' ) -> where( array( 'details_id' => $id ) ) -> update( $data );
        $return = array('status' => $status, 'msg' => '') ;

        die( json_encode($return) ) ;
    }

    /**
     * 判断是否有优先级冲突
     */
    private function _check_timeline_priority( $begin, $end, $prio, $id = 0 )
    {
        $flag = true ;
        $model = Model() ;
        $where = " (endtime >= '".$begin."' AND starttime <= '".$end."') AND priority = " . $prio ;
        if( $id ) {
            $where .= " AND id <> " . $id ;
        }
        $res = $model->table("timeline")->where($where)->select();
        if( is_array($res) && !empty($res) ) {
            $flag = false ;
        }

        return $flag ;
    }
    
}
