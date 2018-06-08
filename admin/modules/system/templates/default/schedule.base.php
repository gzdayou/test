<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    
    .fixed-bar {padding-bottom: 8px;}
    .content{ width: 100%;  padding-top: 10px; }
    .mbtn, .mbtn:hover { height: 64px; line-height: 64px; padding: 0; width:140px; font-size: 16px;border: 1px solid #C9C9C9;background-color: #fff;color: #555;}
    .mbtn_add { font-size: 36px; }
    .layui-btn {  }
    .btn_ul li {float: left; margin: 0 20px 20px 20px;}
    .layui-elem-field { width: 1040px; }
    .layui-table th { text-align: center; font-weight: bold; }
    .btn_line { width: 1040px; text-align: right;}
    .table_hide{display:none;}
    .current,.current:hover {background-color : #a1cadc; border:none;}
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
                foreach( $output['models_list'] as $model ) { 
            ?>
            <li><button class="layui-btn layui-btn-lg mbtn <?php if( $idx == 1 ) { ?>current<?php } ?>" onclick="change(<?php echo $model['ModelId']; ?>, this)" ><?php echo $model['Name']; ?></button></li>
            <?php 
                $idx ++ ;
            } 
            ?>
            <li><button class="layui-btn layui-btn-lg mbtn mbtn_add" onclick="addTemplate()" >+</button></li>
        </ul>
        
        <fieldset class="layui-elem-field">
            <legend>模式详情</legend>
            <div class="layui-field-box">
                <div class="layui-form">
                    <?php 
                    $idx = 1;
                    foreach( $output['models_list'] as $model ) { 
                    ?>
                    <table class="layui-table <?php if($idx>1) { ?>table_hide<?php } ?>" data-id="<?php echo $model['ModelId']; ?>" data-name="<?php echo $model['Name']; ?>" id="model_<?php echo $model['ModelId']; ?>" >
                        <colgroup>
                            <col width="200">
                            <col width="200">
                            <col width="200">
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                            <tr>
                                <th colspan="5"><?php echo $model['Name']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $code_list = $output['code_list'];
                                for ( $i = 0; $i < $output['lines']; $i ++ ) {
                            ?>
                            <tr>
                                <td>
                                <?php
                                    $host = explode(",", $model['Host']) ;
                                    echo isset($host[$i]) ? $code_list[$host[$i]] : "&nbsp;";
                                ?>
                                </td>
                                <td>
                                <?php
                                    $ldb = explode(",", $model['LDB']) ;
                                    echo isset($ldb[$i]) ? $code_list[$ldb[$i]] : "&nbsp;";
                                ?>
                                </td>
                                <td>
                                <?php
                                    $lqb = explode(",", $model['LQB']) ;
                                    echo isset($lqb[$i]) ? $code_list[$lqb[$i]] : "&nbsp;";
                                ?>
                                </td>
                                <td>
                                <?php
                                    $lqt = explode(",", $model['LQT']) ;
                                    echo isset($lqt[$i]) ? $code_list[$lqt[$i]] : "&nbsp;";
                                ?>
                                </td>
                                <td>
                                <?php
                                    $fm = explode(",", $model['FM']) ;
                                    echo isset($fm[$i]) ? $code_list[$fm[$i]] : "&nbsp;";
                                ?>
                                </td>
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
                        <button class="layui-btn layui-btn-normal layui-btn-radius" onclick="edit()">编辑</button>
                        <button class="layui-btn layui-btn-danger layui-btn-radius" onclick="del()">删除</button>
                    </div>
                
                </div>
            </div>
        </fieldset>

    </div>

</div>


<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script>

//获取页面数据
$(function(){

});

function addTemplate() {
    layer.open({
        type: 2,
        title: '新增模式',
        shadeClose: true,
        shade: 0.5,
        area: ['900px', '80%'],
        content: 'index.php?act=schedule&op=add_template' //iframe的url
    });
}

function change(id, obj) {
    //$("#model_" + id).
    $("table:not(.table_hide)").addClass('table_hide');
    $("#model_" + id).removeClass('table_hide');
    $("button.current").removeClass('current');
    $(obj).addClass("current");
}

function del() {
    var id = $("table:not(.table_hide)").attr("data-id") ;
    var name = $("table:not(.table_hide)").attr("data-name") ;
    layer.msg('确认要删除 “'+ name +'” 吗', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "模式删除",
            yes:function(index){
                $.ajax({
                    url: "index.php?act=schedule&op=del_template_ajax",
                    type: "post",
                    timeout : 500,
                    dataType: "json",
                    data: {id: id},
                    success: function (t) {
                        if( t.status == 0 ) {
                            layer.msg(t.msg);
                            return false;
                        }
                        
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
        title: '新增模式',
        shadeClose: true,
        shade: 0.5,
        area: ['900px', '80%'],
        content: 'index.php?act=schedule&op=edit_template&id=' + id //iframe的url
    });
}

</script>