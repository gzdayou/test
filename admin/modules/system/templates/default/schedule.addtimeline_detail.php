<?php defined('ByAcesoft') or exit('Access Invalid!'); ?>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    body{min-width: 400px;}
    .page {padding: 0; min-width: 400px; width: 400px;}
    .layui-form {margin-top: 20px;}
    fieldset { margin: 20px 0 0 20px; }
    input[type="text"] {height: 38px;line-height: 1.3;line-height: 38px\9;border-width: 1px;border-style: solid;background-color: #fff;border-radius: 2px;}
    .layui-btn-sm, .layui-btn-sm:hover { border: 1px solid #C9C9C9;
    background-color: #fff;
    color: #555; }
    .item_opt, .layui-table { margin-left: 40px; }
    .layui-table {width: 360px;}
    table dt, table dd {display: inline-block; }
    table dt {width: 85px;}
    table dd {width: 125px;}
    td {width: 250px;}
    .btn_line { width: 394px; text-align: right; padding-top: 20px; clear:both; }
    .current { background-color: #e6e6e6; }
</style>

<div class="page">
    <form class="layui-form" action="">
        
        <div class="layui-form-item">
            <label class="layui-form-label">是否开启</label>
            <div class="layui-input-block">
                <select name="turn" lay-filter="prio" id="turn">
                    <option value="1" <?php if(1 == $_GET['data_turn']) { ?>selected<?php } ?> >开启</option>
                    <option value="0" <?php if(0 == $_GET['data_turn']) { ?>selected<?php } ?> >关闭</option>
                </select>
            </div>
        </div>

        <table class="layui-table" >
            <tbody>
                <?php foreach($output['models_list'] as $model) { ?>
                <tr <?php if($model['ModelId'] == $_GET['data_id']) { ?>class="current"<?php } ?> data-id="<?php echo $model['ModelId'] ; ?>" >
                    <td>
                        <?php echo $model['Name']; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="btn_line">
            <button class="layui-btn layui-btn-normal layui-btn-radius" type="button" onclick="save()">保存</button>
            <button class="layui-btn layui-btn-danger layui-btn-radius" type="button" onclick="quit()" >取消</button>
        </div>
    </form>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script>

layui.use('form', function(){
    var form = layui.form;

    //form.render('select');
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

function quit() {
    var index = parent.layer.getFrameIndex(window.name);

    parent.layer.close(index);
}

$(".layui-table tr").click(function(){
    $(".current").removeClass('current');
    $(this).addClass("current");
});

function save() {
    var data_id = $(".current").attr("data-id");
    var data_name = $(".current td").html();
    var data_turn = $("#turn").val();
    var turn = data_turn == 0 ? "关" : "开" ;
    var id = "<?php echo $_GET['id'];?>"//页面标签ID
    var str = data_name + "（" + turn + "）" ;

    if( typeof(data_name) != "undefined" ) {
        parent.$("#"+id).attr( "data-id", data_id ) ;
        parent.$("#"+id).attr( "data-turn", data_turn ) ;
        parent.$("#"+id).next().show();
        parent.$("#"+id).html( str )
    }
    parent.layer.close(parent.layer.getFrameIndex(window.name));
}

</script>