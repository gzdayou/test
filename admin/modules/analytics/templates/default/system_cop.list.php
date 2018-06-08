<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
  a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>系统COP</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  
    <div class="search-header">
        
        <dl style="margin-left: 20px;">
            <dt>
                <select name="ldz" class="valid">
                    <option value="1">冷冻站1</option>
                </select>
            </dt>
            <dd>
                <select name="date_type" id="date_type" class="valid" onchange="show_options(this.value)">
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
            <h3>系统信息</h3>
            <dl>
                <dt>系统总制冷：</dt>
                <dd id="t_refrigerator">&nbsp;</dd>
            </dl>
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
                <dt>平均COP：</dt>
                <dd id="avgcop">&nbsp;</dd>
            </dl>
            <p id="pie_content">

            </p>
        </div>

        <div style="clear: both;"></div>

    </div>
    

</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/My97DatePicker/WdatePicker.js"></script>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>

function show_options(val){
    if( val == 1 ) {
        var wdate_day = '<?php echo $output['wdate_day']; ?>' ;
        $("#option").html('选择日期：<input class="Wdate" type="text" onclick="WdatePicker({skin:\'whyGreen\',minDate:\'2010-09-10\',maxDate:\'2050-12-20\'})"/>');
        $(".Wdate").val("<?php echo $output['wdate_day']; ?>");
        getData("<?php echo $output['wdate_day']; ?>", val);
    }
    if( val == 2 ) {
        var wdate_month = '<?php echo $output['wdate_month']; ?>' ;
        $("#option").html('选择月份：<input type="text" class="Wdate"  onclick="WdatePicker({dateFmt:\'yyyy-MM\',minDate:\'2000-1\',maxDate:\'2050-12\'})" />');
        $(".Wdate").val("<?php echo $output['wdate_month']; ?>");
        getData("<?php echo $output['wdate_month']; ?>", val);
    }
}

//显示搜索框
show_options(1);

//$(".Wdate").val("<?php echo $output['wdate']; ?>");
//getData("<?php echo $output['wdate']; ?>", 1);

var pei_option = {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        backgroundColor: 'rgba(0,0,0,0)'
    },
    title: {
        text:null,
    },
    tooltip: {
        headerFormat: '{series.name}<br>',
        pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    legend: {//控制图例显示位置
        floating: true,
        //layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },
    series: [{
        type: 'pie',
        name: '系统COP',
        data: [
            ['良好',   1],
            ['优秀',   0],
            ['中等',   0],
            ['较差',   0]
        ]
    }]
};

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
            text: '系统COP'
        },
        max:10, // 定义Y轴 最大值  
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
        name: '系统COP',
        data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    }]
};
$('#chart_content').highcharts(chart_option);

$("#submitBtn").click(function(){
    var Wdate = $(".Wdate").val();
    var date_type = $("#date_type").val();
    getData(Wdate, date_type);
});

function getData(Wdate, date_type) {
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/modules/analytics/index.php?act=index&op=get_syscop_ajax",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {wdate:Wdate, date_type:date_type},
        success: function (t) {
            if(t.status) {
                var search_data = [];
                avgcop = t.data.avgcop;
                sysinfo = t.data.sysinfo;
                //系统信息
                $("#t_refrigerator").html(sysinfo.ttCooling == null ? "&nbsp;" : ftwo(sysinfo.ttCooling) );//系统总制冷
                $("#t_energy").html(sysinfo.ttEnergy == null ? "&nbsp;" : ftwo(sysinfo.ttEnergy));//总耗电量
                $("#t_time").html(sysinfo.ttRun == null ? "&nbsp;" : ftwo(sysinfo.ttRun));//总运行时间
                $("#avgcop").html(sysinfo.avgcop == null ? "&nbsp;" : ftwo(sysinfo.avgcop));//平均COP
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

                    //饼图
                    $('#pie_content').highcharts();
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

                    //饼图
                    $('#pie_content').highcharts();
                }
            }else{
                //alert(t.msg)
            }
        }
    });
}

</script>