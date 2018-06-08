<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<script type="text/javascript">
function altRows(id){
    if(document.getElementsByTagName){  
        
        var table = document.getElementById(id);  
        var rows = table.getElementsByTagName("tr"); 
         
        for(i = 0; i < rows.length; i++){          
            if(i % 2 == 0){
                rows[i].className = "evenrowcolor";
            }else{
                rows[i].className = "oddrowcolor";
            }      
        }
    }
}

window.onload=function(){
    altRows('alternatecolor');
}
</script>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    .content{width: 100%; height: 838px;}
    .page {padding: 62px 0 0 1%;}
    a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_3 {position: absolute; top: 424px; left: 145px;}
    table.altrowstable{font-family:verdana,arial,sans-serif;font-size:11px;color:#333;border-width:1px;border-color:#a9c6c9;border-collapse:collapse;width:100%}
    table.altrowstable th{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9;font-weight:bold; font-size: 14px;}
    table.altrowstable td{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9}
    .oddrowcolor{background-color:#d4e3e5}
    .evenrowcolor{background-color:#c3dde0}
    #container {height: 763px;}
    .layui-laypage {
        /* display: inline-block; */
        vertical-align: middle;
        margin: 0 auto;
        font-size: 0;
        text-align: center;
    }
    .search-header {width: 1091px;}
</style>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
        <div class="subject">
            <h3>水温报表</h3>
            <h5><?php echo C("project"); ?></h5>
        </div>
        <?php echo $output['top_link'];?> </div>
    </div>

    <div class="search-header">
            <form method="get" action="index.php" target="_self" id="export_form">
            <dl style="margin-left: 20px;">
                <dt>
                    选择日期：
                    <input id="day" name="day" value="<?php echo $output['day']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                </dt>
                <!-- <dd>
                    显示类型：
                    <select name="table_type" id="table_type" class="valid">
                        <option value="1">列表</option>
                        <option value="2">柱状图</option>
                        <option value="3">折线图</option>
                    </select>
                </dd> -->
                <dd>
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="submitBtn">查询</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="export">导出Excel</a>
                </dd>
            </dl>
            <input type="hidden" name="act" value="energy_report" >
            <input type="hidden" name="op" value="temperature" >
            <input type="hidden" name="export" value="1" >
            </form>
    </div>

    <div class="box" id="container">
        <table class="altrowstable" id="alternatecolor">
                <tr>
                    <th>时间</th>
                    <th>冷冻(热)供水温度</th>
                    <th>冷冻(热)回水温度</th>
                    <th>冷却供水温度</th>
                    <th>冷却回水温度</th>
                </tr>

                <?php 
                for ( $i = 0; $i < 22; $i++ ) { 
                    $row = $output['list'][$i] ;
                    if( isset($output['list'][$i]) ) {
                    ?>
                    <tr>
                        <td><?php echo $row['RecordTime']; ?></td>
                        <td><?php echo $row['T1']; ?></td>
                        <td><?php echo $row['T2']; ?></td>
                        <td><?php echo $row['T3']; ?></td>
                        <td><?php echo $row['T4']; ?></td>
                    </tr>
                    <?php
                        } else {
                    ?>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <?php
                        }
                    ?>
                
                <?php } ?>

        </table>
    </div>

    <div class="search-header" id="pagenation">
        &nbsp;
    </div>

</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/My97DatePicker/WdatePicker.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/layui/layui.js"></script>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>
$(function () {

    pagination(<?php echo $output['total'];?>, <?php echo $output['limit'];?>) ;
    
    //导出EXCEL
    $("#export").click(function(){
        $("#export_form").submit();
    });

    $("#submitBtn").click(function(){
        var day = $("#day").val();
        var table_type = $("#table_type").val();
        if( day == "" ) {
            alert("日期为空");
            return false;
        }

        $.ajax({
            url: "index.php?act=energy_report&op=temperature_ajax",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {day : day},
            success: function (t) {
                
                var data = t.data ;
                
                renderTable( data ) ;
                pagination(t.total, <?php echo $output['limit'];?>) ;
            }
        });
    });
});

function renderTable( data ) {
    var list_html = "<table class=\"altrowstable\" id=\"alternatecolor\"><tr><th>时间</th><th>冷冻(热)供水温度</th><th>冷冻(热)回水温度</th><th>冷却供水温度</th><th>冷却回水温度</th></tr>";
    for ( var i = 0; i < 22; i++ )
    {
        var row = data[i] ;
        if(  typeof(row) != "undefined" ) {
            row['T1'] = typeof(row['T1']) != "undefined" ? row['T1'] : 0;
            row['T2'] = typeof(row['T2']) != "undefined" ? row['T2'] : 0;
            row['T3'] = typeof(row['T3']) != "undefined" ? row['T3'] : 0;
            row['T4'] = typeof(row['T4']) != "undefined" ? row['T4'] : 0;
            list_html += "<tr><td>"+ row['RecordTime'] +"</td><td>"+ row['T1'] +"</td><td>"+ row['T2'] +"</td><td>"+ row['T3'] +"</td><td>"+ row['T4'] +"</td></tr>";
        } else {
            list_html += "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        }
    }
    list_html += "</table>";
    $("#container").html(list_html) ;
    altRows('alternatecolor');
}

function pagination(count, limit) {
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        console.log(count);
        console.log(limit);
        //执行一个laypage实例
        laypage.render({
            elem: 'pagenation', 
            count: count, //数据总数，从服务端得到
            limit: limit,
            jump: function(obj, first){

                var day = $("#day").val();
                if( day == "" ) {
                    layer.msg('日期为空');
                    return false;
                }

                //首次不执行
                if(!first){
                    $.ajax({
                        url: "index.php?act=energy_report&op=temperature_ajax",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {day : day, page: obj.curr},
                        success: function (t) {
                            
                            var data = t.data ;
                            renderTable( data );
                        }
                    });
                }
            }
        });
    });
}

</script>
