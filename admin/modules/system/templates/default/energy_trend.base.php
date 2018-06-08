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
    #container {height: 798px;}
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>系统组件耗能</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>

  <div class="search-header">
        <form method="get" action="index.php" target="_self" id="export_form">
        <dl style="margin-left: 20px;">
            <dt>
                选择日期：
                <input id="begin" name="begin" value="<?php echo $output['begin']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                至
                <input id="end" name="end" value="<?php echo $output['end']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
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
            </dd>
        </dl>
        <input type="hidden" name="act" value="energy_report" >
        <input type="hidden" name="export" value="1" >
        </form>
  </div>

  <div class="box" id="container">
      
  </div>

</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/My97DatePicker/WdatePicker.js"></script>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>
$(function () {

    //图表展示
    var chart_option = {
        chart: {
            type: 'column'
        },
        title: {
            text: null
        },
        xAxis: {
            categories: [
                
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: '耗能'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                borderWidth: 0
            }
        },
        series: [{
            name: '总耗能',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }, {
            name: '主机',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
        }, {
            name: '冷冻泵',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
        }, {
            name: '冷却泵',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
        }, {
            name: '热水泵',
            data: [12.4, 33.2, 30.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
        }, {
            name: '冷却塔',
            data: [12.4, 33.2, 30.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
        }]
    };

    var b = "<?php echo $output['begin']; ?>";
    var e = "<?php echo $output['end']; ?>";
    getData(b, e);

    $("#submitBtn").click(function(){
        var begin = $("#begin").val();
        var end = $("#end").val();
        var table_type = $("#table_type").val();
        if( begin == "" || end == "" ) {
            alert("日期为空");
            return false;
        }

        getData(begin, end);
    });
});

function getData(begin, end) {
    $.ajax({
        url: "index.php?act=energy_report&op=component_ajax",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {begin : begin, end : end},
        success: function (t) {
            
            var data = t.data ;
            
            var zhe_option = {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: null
                },
                xAxis: {
                    categories: ['一月', '二月', '三月', '四月', '五月', '六月',
                                '七月', '八月', '九月', '十月', '十一月', '十二月']
                },
                yAxis: {
                    title: {
                        text: '耗能'
                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true
                },
                series: [{
                    name: '总耗能',
                    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
                }, {
                    name: '主机',
                    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
                }, {
                    name: '冷冻泵',
                    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
                }, {
                    name: '冷却泵',
                    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
                }, {
                    name: '热水泵',
                    data: [12.4, 33.2, 30.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
                }, {
                    name: '冷却塔',
                    data: [12.4, 33.2, 30.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
                }]
            };

            zhe_option = get_option( zhe_option, data, end ) ;
            $('#container').highcharts(zhe_option);
            
        }
    });
}

function get_option( option, data, end ) {
    var categories = [];
    var tot = [];
    var host = [];
    var ldb = [];
    var lqb = [];
    var rsb = [];
    var lqt = [];
    if( data.length === 0 )
    {
        categories.push(end);//x轴
        tot.push(0);
        host.push(0);
        ldb.push(0);
        lqb.push(0);
        rsb.push(0);
        lqt.push(0);
        option.yAxis.min = 0;
        option.yAxis.max = 100;
    } 
    else 
    {
        var tmp = 100;
        for ( var j = 0; j < data.length; j++ ) {
            categories.push(data[j]['day'].toString());//x轴
            var t_row = Number(data[j][10]) + Number(data[j][20]) + Number(data[j][30]) + Number(data[j][40]) + Number(data[j][50]) ; 
            
            if( t_row > tmp ) {
                tmp = t_row;
                option.yAxis.max = tmp;
            }
            tot.push(t_row);
            host.push(data[j][10]);
            ldb.push(data[j][20]);
            lqb.push(data[j][30]);
            rsb.push(data[j][40]);
            lqt.push(data[j][50]);
        }
        
    }
    option.xAxis.categories = categories;
    option.series[0].data = tot;
    option.series[1].data = host;
    option.series[2].data = ldb;
    option.series[3].data = lqb;
    option.series[4].data = rsb;
    option.series[5].data = lqt;

    return option;
}

</script>
