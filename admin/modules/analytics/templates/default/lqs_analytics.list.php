<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
  a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
  #chart_content { width: 1210px; }
  .analytics-left { border: none; }
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷却水分析</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  
    <div class="search-header">
        
        <dl style="margin-left: 20px;">
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

        <!-- <div class="analytics-right fl">
            <h3>主机信息</h3>
            <dl>
                <dt>总耗电量：</dt>
                <dd id="t_energy">&nbsp;</dd>
            </dl>
            <p id="pie_content">

            </p> 
        </div> -->

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
        backgroundColor: 'rgba(0,0,0,0)',
        marginRight: 220
    },
    title: {
      text: null
    },
    colors: ['#0000ff', '#90bffc'],
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
            text: '冷却水'
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
    　　align: "right",
    　　verticalAlign: "top",
        layout:"vertical",
    　　x: -30,
    　　y: 30
    },
    series: [{
        name: '冷却供水温度',
        data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    },{
        name: '冷却回水温度',
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
        url: "<?php echo ADMIN_SITE_URL;?>/modules/analytics/index.php?act=index&op=water_analytics_ajax",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {wdate:Wdate, date_type:date_type, device:device},
        success: function (t) {
            if(t.status) {
                var t3 = [];
                var t4 = [];
                data = t.data;

                //按日折线图
                if( date_type == 1 ) {
                    for( i=0; i<24; i++ ) {
                        if( typeof data[i] != 'undefined' ) {
                            t3.push(parseFloat(data[i].T3));
                            t4.push(parseFloat(data[i].T4));
                        } else {
                            t3.push(0);
                            t4.push(0);
                        }
                    }
                    chart_option.series[0].data = t3;
                    chart_option.series[1].data = t4;
                    $('#chart_content').highcharts(chart_option);
                }
                //按月折线图
                if( date_type == 2 ) {
                    var x_days = [];
                    for( j=1; j<=t.days; j++ ) {
                        x_days.push(j);
                        if( typeof data[j] != 'undefined' ) {
                            t3.push(parseFloat(data[j].T3));
                            t4.push(parseFloat(data[j].T4));
                        } else {
                            t3.push(0);
                            t4.push(0);
                        }
                    }
                    chart_option.xAxis.categories = x_days;
                    chart_option.series[0].data = t3;
                    chart_option.series[1].data = t4;
                    $('#chart_content').highcharts(chart_option);
                }
            }else{
                alert(t.msg)
            }
        }
    });
}

</script>