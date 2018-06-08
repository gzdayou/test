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
    //altRows('alternatecolor');
}
</script>
<link rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/layui/css/layui.css" media="all">
<style>
    .content{width: 100%; height: 838px;}
    .page {padding: 62px 0 0 1%;}
    a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_3 {position: absolute; top: 424px; left: 145px;}
    
    table.altrowstable{ table-layout: fixed;font-family:verdana,arial,sans-serif;font-size:11px;color:#333;border-width:1px;border-color:#a9c6c9;border-collapse:collapse;width:100%}
    table.altrowstable tr {height: 34px; white-space: nowrap;}
    table.altrowstable th{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9;font-weight:bold; font-size: 14px; width: 120px;}
    table.altrowstable td{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9}
    .oddrowcolor{background-color:#d4e3e5}
    .evenrowcolor{background-color:#c3dde0}
    #container {height: 763px; width: 1091px;}
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
                    开始：
                    <input id="begin" name="begin" value="<?php echo $output['begin']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                    开始：
                    <input id="end" name="end" value="<?php echo $output['end']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                </dt>
                <dd>
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="submitBtn">查询</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="export">导出Excel</a>
                </dd>
            </dl>
            <input type="hidden" name="act" value="energy_report" >
            <input type="hidden" name="op" value="consum_device" >
            <input type="hidden" name="export" value="1" >
            </form>
    </div>

    <div class="box" id="container"  style="overflow-x:scroll; overflow-y:hidden;" >
        &nbsp;
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
        var begin = $("#begin").val();
        var end = $("#end").val();
        //var table_type = $("#table_type").val();
        if( begin == "" || end == "" ) {
            alert("日期为空");
            return false;
        }

        $.ajax({
            url: "index.php?act=energy_report&op=consum_device_ajax",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {begin : begin, end : end},
            success: function (t) {
                
                var data = t.data ;
                
                renderTable( data ) ;
                //pagination(t.total, <?php echo $output['limit'];?>) ;
            }
        });
    });
});

function renderTable( data ) {
    var list_html = "<table class=\"altrowstable\" id=\"alternatecolor\"><tr>";
    list_html += "<th>时间</th><th width='110'>主机1电表截止码</th><th>主机2电表截止码</th><th>主机3电表截止码</th><th>主机4电表截止码</th>";
    list_html += "<th>冷冻泵1电表截止码</th><th>冷冻泵2电表截止码</th><th>冷冻泵3电表截止码</th>";
    list_html += "<th>冷却泵1电表截止码</th><th>冷却泵2电表截止码</th><th>冷却泵3电表截止码</th>";
    list_html += "</tr>";
    for ( var i = 0; i < 21; i++ )
    {
        var row = data[i] ;
        if(  typeof(row) != "undefined" ) {
            list_html += "<tr><td>"+ row['days'] +"</td><td>"+ row['H1'] +"</td><td>"+ row['H2'] +"</td><td>"+ row['H3'] +"</td><td>"+ row['H4'] +"</td><td>"+ row['D1'] +"</td><td>"+ row['D2'] +"</td><td>"+ row['D3'] +"</td><td>"+ row['Q1'] +"</td><td>"+ row['Q2'] +"</td><td>"+ row['Q3'] +"</td></tr>";
        } else {
            list_html += "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
        }
    }
    list_html += "</table>";
    $("#container").html(list_html) ;
    altRows('alternatecolor');
}

function pagination(count, limit, search = false) {
    layui.use('laypage', function(){
        var laypage = layui.laypage;
        //执行一个laypage实例
        laypage.render({
            elem: 'pagenation', 
            count: count, //数据总数，从服务端得到
            limit: limit,
            jump: function(obj, first){

                var begin = $("#begin").val();
                var end = $("#end").val();
                //var table_type = $("#table_type").val();
                if( begin == "" || end == "" ) {
                    alert("日期为空");
                    return false;
                }

                //首次不执行
                if(!search){
                    $.ajax({
                        url: "index.php?act=energy_report&op=consum_device_ajax",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {begin : begin, end : end,  page: obj.curr},
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
