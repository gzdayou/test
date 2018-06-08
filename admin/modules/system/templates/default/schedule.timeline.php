<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    .fixed-bar {padding-bottom: 8px;}
    .content{ width: 100%;  padding-top: 10px; }
    .mbtn, .mbtn:hover { height: 64px; line-height: 64px; padding: 0; width:140px; font-size: 16px;border: 1px solid #C9C9C9;background-color: #fff;color: #555;}
    .mbtn_add, .mbtn_add:hover { font-size: 36px; }
    .layui-btn {  }
    .btn_ul { width: 1085px; }
    .btn_ul li {float: left; margin: 0 20px 20px 20px;}
    .layui-elem-field { width: 1040px; clear: both; }
    .layui-table th { text-align: center; font-weight: bold; }
    .btn_line { width: 1040px; height: 40px; }
    .table_hide{display:none;}
    .current,.current:hover {background-color : #a1cadc; border:none;}
    dl dt, dl dd {display: inline-block; }
    dl dt {width: 85px;}
    dl dd {width: 125px;}
    td {width: 250px;}
    .layui-btn-radius, .layui-btn-radius:hover{border: 1px solid #C9C9C9;
    background-color: #fff;
    color: #555;}
</style>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
        <div class="subject">
            <h3>日程策略</h3>
            <h5><?php echo C("project"); ?></h5>
        </div>
        <?php echo $output['top_link'];?> </div>
    </div>

    <div class="content">

        <ul class="btn_ul">
            <?php 
            $idx = 1;
            foreach( $output['timeline_list'] as $row ) {
            ?>
            <li><button class="layui-btn layui-btn-lg mbtn <?php if( $idx == 1 ) { ?>current<?php } ?>" onclick="change(<?php echo $row['details_id']; ?>, this)" id="btn<?php echo $row['details_id']; ?>" ><?php echo $row['name']; ?></button></li>
            <?php 
                $idx ++ ;
            }
            ?>
            <li><button class="layui-btn layui-btn-lg mbtn mbtn_add" onclick="add_timeline()" >+</button></li>
        </ul>

        <fieldset class="layui-elem-field">
            <legend>时间轴详情</legend>
            <div class="layui-field-box">
                <div class="layui-form">
                    <?php 
                    $idx = 1;
                    foreach( $output['timeline_list'] as $row ) { 
                    ?>
                    <table class="layui-table <?php if($idx>1) { ?>table_hide<?php } ?>" data-id="<?php echo $row['details_id']; ?>" data-name="<?php echo $row['name']; ?>" id="model_<?php echo $row['details_id']; ?>" >
                        <tbody>
                            
                        <?php 
                            $startTime = C('timeline_begin'); 
                            $index = 1;
                            for ( $i = 1; $i <= 12; $i++ ) { 
                        ?>
                        <tr>
                            <?php 
                                for( $j = 1; $j <= 4; $j++ ) {
                                    $column_val = 0 ;
                                    $column = 'time' . $index ;
                                    $column_val = $row[$column] ;
                                    $model_id = $column_val >> 8 ;
                                    $open_flag = $column_val & 0xf ;

                                    $endTime = date("H:i", strtotime("$startTime +30 min"));
                            ?>
                            <td>
                                <dl>
                                    <dt><?php echo $startTime . "-" . $endTime; ?></dt>
                                    <dd id="time<?php echo $index;?>">
                                    <?php 
                                        if( $model_id > 0 ) {
                                            $str = "";
                                            $str .= $output['models'][$model_id] ;
                                            $str .= $open_flag == 1 ? "（开）" : "（关）" ;
                                            echo $str ;
                                        }
                                    ?>
                                    </dd>
                                </dl>
                            </td>
                            <?php
                                    $startTime = $endTime ;
                                    $index ++ ;
                                }
                            ?>
                        </tr>
                        <?php 
                            } 
                        ?>
                            
                        </tbody>
                    </table>
                    <?php 
                        $idx++;
                    } 
                    ?>

                    <div class="btn_line">
                        <?php 
                        $idx = 1;
                        $dateType = array('0' => '每一天', '1' => '工作日', '2' => '节假日') ;
                        foreach( $output['timeline_list'] as $row ) { 
                        ?>
                        <div id="timeline<?php echo $row['details_id'];?>" class="date_block <?php if($idx>1) { ?>table_hide<?php } ?>" style="float: left; line-height: 40px; margin-left: 10px; font-size: 16px;">
                            <?php echo $row['starttime'];?>至<?php echo $row['endtime'];?>，<?php echo $dateType[$row['datetype']] ?>，优先级<?php echo $row['priority'];?>，已<?php echo $row['active'] == 1 ? '激活' : '关闭' ;?>
                        </div>
                        <?php 
                            $idx++;
                        }
                        ?>
                        <div style="float: right;">
                            <button class="layui-btn layui-btn-warm layui-btn-radius" onclick="active()">激活</button>
                            <button class="layui-btn layui-btn-normal layui-btn-radius" onclick="edit()">编辑</button>
                            <button class="layui-btn layui-btn-danger layui-btn-radius" onclick="del()">删除</button>
                        </div>
                    </div>

                </div>
            </div>
        </fieldset>

    </div>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script>
<?php if( intval($_GET['details_id']) > 0 ) { ?>
$(function(){
    var id = <?php echo intval($_GET['details_id']) ; ?> ;
    change(id, $("#btn"+id)) ;
});
<?php } ?>

function add_timeline() {
    layer.open({
        type: 2,
        title: '新增时间轴',
        shadeClose: true,
        shade: 0.5,
        area: ['900px', '90%'],
        content: 'index.php?act=schedule&op=add_timeline' //iframe的url
    });
}

function change(id, obj) {
    //$("#model_" + id).
    $("table:not(.table_hide)").addClass('table_hide');
    $("#model_" + id).removeClass('table_hide');
    $("button.current").removeClass('current');
    $(obj).addClass("current");
    //时间区间切换
    $(".date_block:not(.table_hide)").addClass('table_hide');
    $("#timeline" + id).removeClass('table_hide');
}

function active() {
    var details_id = $("table:not(.table_hide)").attr("data-id") ;
    var name = $("table:not(.table_hide)").attr("data-name") ;
    layer.alert('确认要激活 “'+ name +'” 吗', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "时间轴激活",
            yes:function(index){
                $.ajax({
                    url: "index.php?act=schedule&op=active_timeline_ajax",
                    type: "post",
                    timeout : 500,
                    dataType: "json",
                    data: {id: details_id},
                    success: function (t) {
                        window.location.reload();
                    }
                });
                layer.close(index);
            },
            btn2:function(){
                return ;
            }
        }
    );
}

function edit() {
    var id = $("table:not(.table_hide)").attr("data-id") ;
    layer.open({
        type: 2,
        title: '编辑时间轴',
        shadeClose: true,
        shade: 0.5,
        area: ['900px', '80%'],
        content: 'index.php?act=schedule&op=edit_timeline&id=' + id //iframe的url
    });
}

function del() {
    var id = $("table:not(.table_hide)").attr("data-id") ;
    var name = $("table:not(.table_hide)").attr("data-name") ;
    layer.alert('确认要删除 “'+ name +'” 吗', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "时间轴删除",
            yes:function(index){
                $.ajax({
                    url: "index.php?act=schedule&op=del_timeline_ajax",
                    type: "post",
                    timeout : 500,
                    dataType: "json",
                    data: {id: id},
                    success: function (t) {
                        window.location.reload();
                    }
                });
                layer.close(index);
            },
            btn2:function(){
                return ;
            }
        }
    );
}

</script>