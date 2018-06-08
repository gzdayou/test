<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    .alarm {
        text-shadow: none!important;
        font-size: 12px;
        font-weight: 300;
        padding: 3px 6px;
        color: #fff;
        border-radius: .25em;
    }
    .alarm_critical {
        background-color: red;
    }
    .alarm_important {
        background-color: #36c6d3;
    }
    .alarm_normal {
        background-color: #bac3d0;
    }
</style>

<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>报警管理</h3>
                <h5><?php echo C("project"); ?></h5>
            </div>
        </div>
    </div>

    <div id="flexigrid"></div>
</div>
<script type="text/javascript">
    $(function(){
        $("#flexigrid").flexigrid({
            url: 'index.php?act=index&op=get_xml',
            colModel : [
                {display: '报警时间', name : 'alarm_time', width : 200, sortable : true, align: 'center'},
                {display: '设备名称', name : 'device', width : 120, sortable : true, align: 'left'},
                {display: '错误信息', name : 'error_info', width : 120, sortable : true, align: 'left'},
            ],
            sortname: "id",
            sortorder: "desc",
            title: '报警列表'
        });

        $(".bDiv").css("height","720px");
    });

    function fg_del(id) {
        if(confirm('删除后将不能恢复，确认删除这项吗？')){
            $.getJSON('index.php?act=snstrace&op=tracedel', {id:id}, function(data){
                if (data.state) {
                    $("#flexigrid").flexReload();
                } else {
                    showError(data.msg)
                }
            });
        }
    }
</script>