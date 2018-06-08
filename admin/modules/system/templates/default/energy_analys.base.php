<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
  a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
  .box {width: 1100px;}
  .chart_box {width: 550px; float : left; border: none; }
  .chart_box h3 {height: 30px; line-height: 30px; font-size: 16px; padding-left: 10px; width: 530px;}
  .container {height: 370px; }
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>能耗分析</h3>
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
    
    <div class="box">
        
        <div class="chart_box">
            <h3 style="background-color: #26c3bc; ">冷热源站用电趋势与与室外温度</h3>
            <div class="container" id="energy_and_temperature"></div>
        </div>

        <div class="chart_box">
            <h3 style="background-color: #479ee0; ">冷热源站系统用电趋势</h3>
            <div class="container" id="energy_total_trend"></div>
        </div>

        <div class="chart_box">
            <h3 style="background-color: #f9aa36; ">冷热源站用电分项饼图</h3>
            <div class="container" id="energy_pie"></div>
        </div>

        <div class="chart_box">
            <h3 style="background-color: #63c7da; ">冷热源站分项用电趋势</h3>
            <div class="container" id="energy_sub_trend"></div>
        </div>

    </div>

</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/My97DatePicker/WdatePicker.js"></script>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>

var device = [] ;
device[10] = "主机";
device[20] = "冷冻泵";
device[30] = "冷却泵";
device[40] = "热水泵";
device[50] = "冷却塔";

var option_one = {
		chart: {
				zoomType: 'xy'
		},
		title: {
				text: null
		},
		xAxis: [{
				categories: ['1', '2', '3', '4', '5', '6','7', '8', '9', '10', '11', '12'],
				crosshair: true
		}],
		yAxis: [{ // Primary yAxis
				labels: {
						format: '{value}°C',
						style: {
								color: Highcharts.getOptions().colors[1]
						}
				},
				title: {
						text: '室外温度温度',
						style: {
								color: Highcharts.getOptions().colors[1]
						}
				}
		}, { // Secondary yAxis
				title: {
						text: '用电量',
						style: {
								color: Highcharts.getOptions().colors[0]
						}
				},
				labels: {
						format: '{value}',
						style: {
								color: Highcharts.getOptions().colors[0]
						}
				},
                opposite: true,
		}],
		tooltip: {
				shared: true
		},
		// legend: {
		// 		layout: 'vertical',
		// 		align: 'left',
		// 		x: 70,
		// 		verticalAlign: 'top',
		// 		y: 10,
		// 		floating: true,
		// 		backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        // },
        legend: {
 				layout: 'horizontal',
 				align: 'center',
 		},
		series: [{
				name: '用电量',
				type: 'column',
				yAxis: 1,
				data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
				tooltip: {
					valueSuffix: 'kW/h'
				}
		}, {
				name: '室外温度',
				type: 'spline',
				data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
				tooltip: {
					valueSuffix: '°C'
				}
		}]
};

var option_two = {
        chart: {
            type: 'line'
        },
        title: {
            text: null
        },
        legend : {
            enabled : false
        },
        xAxis: {
            categories: ["0"]
        },
        yAxis: {
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            title: {
                text: '电量'
            },
            min: 0
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: '电量',
            data: [0]
        }]
    } ;

var option_three = {
        title: {
				text: null
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
                            enabled: true,
								format: '<b>{point.name}</b>: {point.percentage:.1f} %',
								style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
								}
						},
						showInLegend: true // 设置饼图是否在图例中显示
				}
		},
		series: [{
				type: 'pie',
				name: '用电分项占比',
				data: [
						['主机',   0],
						['冷冻泵',       0],
						['冷却泵',    0],
						['热水泵',     0],
						['冷却塔',  0]
				]
		}]
} ;

var option_four = {
    chart: {
            type: 'line'
        },
        title: {
            text: null
        },
        legend: {
 				layout: 'horizontal',
 				align: 'center',
 		},
        xAxis: {
            categories: ["0"]
        },
        yAxis: {
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            title: {
                text: '电量'
            },
            min: 0
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: false
                },
                enableMouseTracking: true
            }
        },
        series: [{
				name: '主机',
				data: [0]
		}, {
				name: '冷冻泵',
				data: [0]
		}, {
				name: '冷却泵',
				data: [0]
		}, {
				name: '热水泵',
				data: [0]
		}, {
				name: '冷却塔',
				data: [0]
		}]
} ;

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

$("#submitBtn").click(function(){
    var type = $("#date_type").val() ;
    var wdate = $(".Wdate").val() ;

    getData( wdate, type ) ;
}) ;

function getData( wdate, type ) 
{
    $.ajax({
        url: "index.php?act=energy_analys&op=ajax_data",
        type: "post",
        timeout : 500,
        dataType: "json",
        data: {wdate : wdate, type : type},
        success: function (t) {

            //冷热源站用电趋势与与室外温度
            var data_one_energy = [] ;
            var date_one_ot = [] ;
            var categories_one = [] ;
            $.each(t.data.energy_and_ot, function(index,val){
                categories_one.push( index.toString() ) ;
                data_one_energy.push( Number(val.energy) ) ;
                date_one_ot.push( Number(val.ot) ) ;
            });

            option_one.xAxis[0].categories = categories_one ;
            option_one.series[0].data = data_one_energy ;
            option_one.series[1].data = date_one_ot ;
            $('#energy_and_temperature').highcharts(option_one);

            //冷热源站系统用电趋势
            option_two.xAxis.categories = categories_one ;
            option_two.series[0].data = data_one_energy ;
            $('#energy_total_trend').highcharts(option_two);

            //冷热源站用电分项饼图
            var pie = [] ;
            
            $.each(t.data.energy_pie, function(index,val){
                var tmp = [] ;
                tmp.push( device[index] ) ;
                tmp.push( Number(val) ) ;
                pie.push( tmp ) ;
            });
            option_three.series[0].data = pie ;
            $('#energy_pie').highcharts(option_three);

            //冷热源站分项用电趋势
            var cat_four = [], data_10 = [], data_20 = [], data_30 = [], data_40 = [] , data_50 = [] ;
            $.each(t.data.part_trend, function(index,val){
                cat_four.push( index.toString() ) ;
                data_10.push( Number(val[10]) ) ;
                data_20.push( Number(val[20]) ) ;
                data_30.push( Number(val[30]) ) ;
                data_40.push( Number(val[40]) ) ;
                data_50.push( Number(val[50]) ) ;
            });
            option_four.xAxis.categories = cat_four ;
            option_four.series[0].data = data_10 ;
            option_four.series[1].data = data_20 ;
            option_four.series[2].data = data_30 ;
            option_four.series[3].data = data_40 ;
            option_four.series[4].data = data_50 ;
            $('#energy_sub_trend').highcharts(option_four);
            
        }
    });

    
}

</script>