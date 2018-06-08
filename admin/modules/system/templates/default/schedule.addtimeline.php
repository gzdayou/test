<?php defined('ByAcesoft') or exit('Access Invalid!'); ?>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    body{min-width: 860px;}
    .page {padding: 0; min-width: 860px; width: 860px;}
    .layui-form {margin-top: 20px;}
    fieldset { margin: 20px 0 0 20px; }
    input[type="text"] {height: 38px;line-height: 1.3; border-color: #e6e6e6; line-height: 38px\9;border-width: 1px;border-style: solid;background-color: #fff;border-radius: 2px;}
    .layui-btn-sm, .layui-btn-sm:hover { border: 1px solid #C9C9C9;
    background-color: #fff;
    color: #555; }
    .item_opt, .layui-table { margin-left: 40px; }
    .layui-table {width: 820px;}
    table dt, table dd {display: inline-block; }
    table dt {width: 85px;}
    table dd {width: 150px; cursor: default; float: left;}
    td {width: 250px;}
    .hbg{ background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/btn_delete.png') no-repeat right; width: 20px; height: 20px;cursor: pointer; display: none; }
    .btn_line { width: 850px; text-align: right; padding-top: 20px; padding-bottom: 20px; clear:both; }
</style>

<div class="page">
    <form class="layui-form" action="">
    <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input id="timeline_name" name="timeline_name" value="" type="text" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">起止时间</label>
            <div class="layui-input-block">
                <input id="begin" name="begin" value="" type="text" >
                至
                <input id="end" name="end" value="" type="text" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">优先级</label>
            <div class="layui-input-block">
            <select name="prio" lay-filter="prio" id="prio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">类别</label>
            <div class="layui-input-block">
                <select name="types" lay-filter="types" id="types">
                    <option value="0">每一天</option>
                    <option value="1">工作日（星期一到星期五）</option>
                    <option value="2">节假日（星期六到星期天）</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否激活</label>
            <div class="layui-input-block">
                <select name="active" lay-filter="active" id="active">
                    <option value="0">否</option>
                    <option value="1">是</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item item_opt">
            <!-- <button class="layui-btn layui-btn-sm" type="button" onclick="add()">增加</button>
            <button class="layui-btn layui-btn-sm" type="button" onclick="del()">删除</button> -->
            <span style="color: #555; line-height: 30px;">说明：1.点击空白时间轴可进行设置；2.拖动已设置时间轴可复制到其他时间轴</span>
        </div>

        <table class="layui-table" >
            <tbody>
                <?php 
                    $startTime = C('timeline_begin'); 
                    $index = 1;
                    for ( $i = 1; $i <= 12; $i++ ) { 
                ?>
                <tr>
                    <?php 
                        for( $j = 1; $j <= 4; $j++ ) {
                            $endTime = date("H:i", strtotime("$startTime +30 min"));
                    ?>
                    <td>
                        <dl>
                            <dt><?php echo $startTime . "-" . $endTime; ?></dt>
                            <dd id="time<?php echo $index;?>" onclick="setting(this)" data-id="" data-turn="" >&nbsp;</dd>
                            <dd class="hbg"  onclick="del('time<?php echo $index;?>')" ></dd>
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

        <div class="btn_line">
        <button class="layui-btn layui-btn-warm layui-btn-radius" type="button" onclick="qk()">清空</button>
            <button class="layui-btn layui-btn-normal layui-btn-radius" type="button" onclick="save()">保存</button>
            <button class="layui-btn layui-btn-danger layui-btn-radius" type="button" onclick="quit()" >取消</button>
        </div>
    </form>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jQuery1.11.3.min.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui.js"></script>
<script>

layui.use('form', function(){
    var form = layui.form;

    form.render('select');
});

layui.use('laydate', function(){
    var laydate = layui.laydate;
    
    //执行一个laydate实例
    laydate.render({
        elem: '#begin' //指定元素
    });
    laydate.render({
        elem: '#end' //指定元素
    });
});

function add() {
    layer.open({
        type: 2,
        title: '新增模式关联',
        shadeClose: true,
        shade: 0.5,
        area: ['400px', '80%'],
        content: 'index.php?act=schedule&op=add_timeline_detail' //iframe的url
    });
}

$().ready(function(e) {
    //拖拽复制体
    $('dd[id^="time"]').draggable({
        helper:"clone",
        cursor: "move"
        });

    //释放后
    $('dd[id^="time"]').droppable({
        drop:function(event,ui){
            $(this).children().remove();
            var source = ui.draggable.clone();
            $(this).html(source.html());
            $(this).attr("data-id", source.attr("data-id"));
            $(this).attr("data-turn", source.attr("data-turn"));
            $(this).next().show();
        }
    });
});

function setting(obj) {
    var id = $(obj).attr('id')
    var url = 'index.php?act=schedule&op=add_timeline_detail&id=' + id;

    var model_id = $(obj).attr('data-id');
    if( model_id != "" ) {
        url += '&data_id=' + model_id ;
    }

    var data_turn = $(obj).attr('data-turn');
    if( data_turn != "" ) {
        url += '&data_turn=' + data_turn ;
    }

    layer.open({
        type: 2,
        title: '新增模式关联',
        shadeClose: true,
        shade: 0.5,
        area: ['430px', '60%'],
        content: url //iframe的url
    });
}

function save() {
    var timeline_name = $("#timeline_name").val() ;
    var begin = $("#begin").val() ;
    var end = $("#end").val() ;
    var prio = $("#prio").val() ;
    var types = $("#types").val() ;

    if ( timeline_name == "" ) {
        layer.msg("时间轴名称不能为空哦")
        return false;
    }

    if( begin == "" || end == "" ) {
        layer.msg("起止时间不能为空哦")
        return false;
    }

    var formData = new FormData($('form')[0]);
    for( i = 1; i <= 48; i ++ ) {
        var id = "time" + i ;
        formData.append( id + "_modelid", $("#" + id).attr("data-id") );
        formData.append( id + "_modelturn", $("#" + id).attr("data-turn") );
    }

    $.ajax({
        type: 'post',
        url: 'index.php?act=schedule&op=addtimeline_ajax',
        data: formData,
        contentType: false,// 当有文件要上传时，此项是必须的，否则后台无法识别文件流的起始位置(详见：#1)
        processData: false,// 是否序列化data属性，默认true(注意：false时type必须是post，详见：#2)
        success: function(data) {
            var obj = JSON.parse(data);
            if(obj.status == 0) {
                layer.msg(obj.msg, {offset: '100px'});
                return false ;
            } else {
                window.parent.location.reload();
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            }
        }
    }) ;
}

function qk() {
    $("#begin").val("");
    $("#end").val("");
    for ( i = 1; i <= 48; i++ ) {
        id = "time" + i ;
        $("#" + id).html("&nbsp;");
        $("#" + id).attr("data-id", "");
        $("#" + id).attr("data-turn", "");
    }
    $(".hbg").hide();
}

function quit() {
    var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);
}

function del(id) {
    $("#" + id).html("&nbsp;");
    $("#" + id).attr("data-id", "");
    $("#" + id).attr("data-turn", "");
    $("#" + id).next().hide();
}
</script>