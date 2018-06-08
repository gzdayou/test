<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    body{min-width: 860px;}
    .page {padding: 0; min-width: 860px; width: 860px;}
    .layui-form {margin-top: 20px;}
    ul {float: left; margin: 20px 10px 0 20px;}
    fieldset { margin: 20px 0 0 20px; }
    .btn_line { width: 700px; text-align: center; padding-top: 50px; clear:both; }
    ul#device_FM {float: right;}
    ul#device_FM li {width: 182px;}
    ul#device_FM span {width:140px;}
    input[type="text"] {height: 38px;width: 80%;line-height: 1.3;line-height: 38px\9;border-width: 1px;border-style: solid;background-color: #fff;border-radius: 2px;}
</style>

<div class="page">
    <form class="layui-form" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">模式名称</label>
            <div class="layui-input-block">
                <input type="text" id="model_name" name="model_name" value="<?php echo $output['model_detail']['Name']; ?>" placeholder="请输入模式名" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div>
            <?php 
                foreach($output['device_list'] as $type => $list) { 
                    $column = isset($output['model_detail'][$type]) ? $output['model_detail'][$type] : array() ;
                    $column = explode(",", $column) ;
            ?>
            <ul id="device_<?php echo $type;?>">
                <?php 
                    foreach($list as $val) { 
                ?>
                <li>
                    <input type="checkbox" name="<?php echo $type;?>[]" value="<?php echo $val['TagName'];?>" title="<?php echo $val['DeviceName'];?>" <?php if( in_array($val['TagName'], $column) ) { ?>checked<?php } ?> >
                </li>
                <?php } ?>
            </ul>
            <?php } ?>

        </div>

        <div class="btn_line">
            <input type="hidden" name="id" value="<?php echo $output['model_detail']['ModelId']; ?>" >
            <button class="layui-btn layui-btn-normal layui-btn-radius" type="button" onclick="save()">保存</button>
            <button class="layui-btn layui-btn-danger layui-btn-radius" type="button" onclick="dclear()">清空</button>
        </div>
        
    </form>
</div>


<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script>

$(function(){
    $("#device_RSB").hide();
});

layui.use('form', function(){
  var form = layui.form;
  //各种基于事件的操作，下面会有进一步介绍
});

function save() {

    if( $("#model_name").val() == "" ) {
        layer.tips('请输入模式名', '#model_name');
        return false;
    }

    var formData = new FormData($('form')[0]);

    $.ajax({
        type: 'post',
        url: 'index.php?act=schedule&op=edit_template_ajax',
        data: formData,
        contentType: false,// 当有文件要上传时，此项是必须的，否则后台无法识别文件流的起始位置(详见：#1)
        processData: false,// 是否序列化data属性，默认true(注意：false时type必须是post，详见：#2)
        success: function(data) {
            window.parent.location.reload();
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        }
    })
}

function dclear() {
    $('form')[0].reset();
    $(':input[type="checkbox"]', 'form').each(function(){
        $(this).removeAttr('checked');
    });
    $("#model_name").val("");
}

</script>