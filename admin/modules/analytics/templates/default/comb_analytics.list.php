<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
  a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>综合数据分析</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  
    <div class="search-header">
        
        <dl style="margin-left: 20px;">
            <dt>
                <select id="comb_type" name="ldz" class="valid">
                    <option value="1">系统总耗电量</option>
                    <!-- <option value="2">系统总功率</option>
                    <option value="3">系统总制冷量</option>
                    <option value="4">系统运行时间</option>
                    <option value="5">系统COP值</option>
                    <option value="6">系统当天节省电量</option>
                    <option value="7">系统当天CO2减排量</option>
                    <option value="8">系统当天节省费用</option> -->
                    <option value="9">主机电量</option>
                    <option value="10">冷冻泵电量</option>
                    <option value="11">冷却泵电量</option>
                    <option value="12">热水泵电量</option>
                    <option value="13">冷却塔电量</option>
                </select>
            </dt>
            <dd id="option">
                选择日期
                <input id="begin" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                <input id="end" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
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
            <h3>节能数据</h3>
            <dl>
                <dt>系统总节能：</dt>
                <dd id="t_energy">0.00</dd>
            </dl>
            <dl>
                <dt>CO2总减排：</dt>
                <dd id="t_co2">0.00</dd>
            </dl>
            <dl>
                <dt>节省总费用：</dt>
                <dd id="t_money">0.00</dd>
            </dl>
            <!-- <dl>
                <dt>开机时间：</dt>
                <dd>&nbsp;</dd>
            </dl>
            <dl>
                <dt>关机时间：</dt>
                <dd>&nbsp;</dd>
            </dl> -->
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
//show_option(1);
$("#begin").val("<?php echo $output['begin']; ?>");
$("#end").val("<?php echo $output['end']; ?>");
getData("<?php echo $output['begin']; ?>", "<?php echo $output['end']; ?>", 1);

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
        categories : ['']
    },
    yAxis: {
        title: {
            text: null
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
        name: null,
        data : [0]
    }]
};
$('#chart_content').highcharts(chart_option);

$("#submitBtn").click(function(){
    var begin = $("#begin").val();
    var end = $("#end").val();
    var comb_type = $("#comb_type").val();

    if( begin == "" || end == "" ) {
        alert("时间为空");
    }

    getData(begin, end, comb_type)
});

function getData(begin, end, comb_type) {
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/modules/analytics/index.php?act=index&op=comb_analytics_ajax",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {begin:begin, end:end, comb_type:comb_type},
        success: function (t) {
            if(t.status) {
                var search_data = [];
                var categories = [];
                data = t.data;

                //折线图
                var tmp = 10;
                if ( data == null ) return ;
                data.forEach(function(currentValue, index, arr) {
                    if( currentValue.yval > tmp ) {
                        tmp = parseInt(currentValue.yval) + 10;
                        chart_option.yAxis.max = tmp;
                    }
                    
                    search_data.push(parseFloat(ftwo(currentValue.yval)));
                    categories.push(parseFloat(currentValue.days));
                });
                
                if( search_data != [] ) {
                    var names = new Array(13) ;
                    names[1] = "系统总耗电量";
                    names[2] = "系统总功率";
                    names[3] = "系统总制冷量";
                    names[4] = "系统运行时间";
                    names[5] = "系统COP值";
                    names[6] = "系统当天节省电量";
                    names[7] = "系统当天CO2减排量";
                    names[8] = "系统当天节省费用";
                    names[9] = "主机电量";
                    names[10] = "冷冻泵电量";
                    names[11] = "冷却泵电量";
                    names[12] = "热水泵电量";
                    names[13] = "冷却塔电量";
                    
                    chart_option.series[0].name = names[comb_type];
                    chart_option.series[0].data = search_data;
                    chart_option.xAxis.categories = categories;
                    $('#chart_content').highcharts(chart_option);
                }

                var save_data = t.save_data;
                $("#t_energy").html(save_data.save_energy);
                $("#t_co2").html(save_data.save_co2);
                $("#t_money").html(save_data.save_money);

            }else{
                //alert(t.msg)
            }
        }
    });
}

</script>