<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
  a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷却泵分析</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  
    <div class="search-header">
        
        <dl style="margin-left: 20px;">
            <dt>
                <select name="host" class="valid" id="device">
                    <option value="301">冷却泵1</option>
                    <option value="302">冷却泵2</option>
                    <option value="303">冷却泵3</option>
                </select>
            </dt>
            <dd>
                <select name="date_type" id="date_type" class="valid" onchange="show_option(this.value)">
                    <option value="1">按日</option>
                    <option value="2">按月</option>
                </select>
            </dd>
            <dd id="option">

            </dd>
            <dd>
                <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="submitBtn">查询</a>
            </dd>
        </dl>
    </div>
    <div class="chart_box">

        <div class="analytics-left fl">
            <div id="chart_content"></div>
        </div>

        <div class="analytics-right fl">
            <h3>冷却泵信息</h3>
            <dl>
                <dt>总耗电量：</dt>
                <dd id="t_energy">&nbsp;</dd>
            </dl>
            <dl>
                <dt>总运行时间：</dt>
                <dd id="t_time">&nbsp;</dd>
            </dl>
            <!-- <dl>
                <dt>开机时间：</dt>
                <dd>&nbsp;</dd>
            </dl>
            <dl>
                <dt>关机时间：</dt>
                <dd>&nbsp;</dd>
            </dl> -->
            <dl>
                <dt>均传输系数：</dt>
                <dd id="avgcop">&nbsp;</dd>
            </dl>
            <!-- <p id="pie_content">

            </p> -->
        </div>

        <div style="clear: both;"></div>

    </div>
    

</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/My97DatePicker/WdatePicker.js"></script>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>

//显示搜索框
show_option(1);
$(".Wdate").val("<?php echo $output['wdate']; ?>");
getData("<?php echo $output['wdate']; ?>", 1, 301);

var chart_option = {
    chart: {
        backgroundColor: 'rgba(0,0,0,0)'
    },
    title: {
      text: null
    },
    xAxis: {
        labels: {
            style: {
                color: '#000',//颜色
                fontSize:'14px'  //字体
            },
            step:2
        },
        categories: ['00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00']
    },
    yAxis: {
        title: {
            text: '传输系数'
        },
        max:50, // 定义Y轴 最大值  
        min:0, // 定义最小值  
        labels: {
            style: {
                color: '#000',//颜色
                fontSize:'14px'  //字体
            }
        }
    },
    legend: {
        enabled: false
    },
    series: [{
        name: '传输系数',
        data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    }]
};
$('#chart_content').highcharts(chart_option);

$("#submitBtn").click(function(){
    var Wdate = $(".Wdate").val();
    var date_type = $("#date_type").val();
    var device = $("#device").val();
    getData(Wdate, date_type, device);
});

function getData(Wdate, date_type, device) {
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/modules/analytics/index.php?act=index&op=device_analytics_ajax",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {wdate:Wdate, date_type:date_type, device:device},
        success: function (t) {
            if(t.status) {
                var search_data = [];
                avgcop = t.data.avgcop;
                sysinfo = t.data.sysinfo;
                //系统信息
                //$("#t_refrigerator").html(sysinfo.t_refrigerator == null ? "&nbsp;" : parseFloat(sysinfo.t_refrigerator).toFixed(2));//系统总制冷
                $("#t_energy").html(sysinfo.t_energy == null ? "&nbsp;" : parseFloat(sysinfo.t_energy).toFixed(2));//总耗电量
                $("#t_time").html(sysinfo.t_time == null ? "&nbsp;" : parseFloat(sysinfo.t_time).toFixed(2));//总运行时间
                $("#avgcop").html(sysinfo.avgfreq == null ? "&nbsp;" : parseFloat(sysinfo.avgfreq).toFixed(2));//平均COP
                //按日折线图
                if( date_type == 1 ) {
                    for( i=0; i<24; i++ ) {
                        if( typeof avgcop[i] != 'undefined' ) {
                            search_data.push(parseFloat(avgcop[i]));
                        } else {
                            search_data.push(0);
                        }
                    }
                    chart_option.series[0].data = search_data;
                    $('#chart_content').highcharts(chart_option);
                }
                //按月折线图
                if( date_type == 2 ) {
                    var x_days = [];
                    for( j=1; j<=t.days; j++ ) {
                        x_days.push(j);
                        if( typeof avgcop[j] != 'undefined' ) {
                            search_data.push(parseFloat(avgcop[j]));
                        } else {
                            search_data.push(0);
                        }
                    }
                    chart_option.xAxis.categories = x_days;
                    chart_option.series[0].data = search_data;
                    $('#chart_content').highcharts(chart_option);
                }
            }else{
                alert(t.msg)
            }
        }
    });
}

</script>