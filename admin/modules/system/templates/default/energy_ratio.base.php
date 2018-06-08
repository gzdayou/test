<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_RESOURCE_URL;?>/css/tabstyle.css" rel="stylesheet" type="text/css">
<style>
    .content{ padding-top: 10px; padding-left: 10px; width: 100%; color: #fff; height: 828px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .data_box { width: 540px; height: 300px; }
    .data_box h3 { height: 30px; font-size: 16px; line-height: 30px; padding-left: 10px; }
    .data_box .box_zhu { height: 270px; width: 540px; }
    .fl {float: left;}
    .fr {float: right;}
    #c_one,#c_two { float: left; }
    .biao { border : 1px solid #333; width: 80px; border-radius : 3px; background-color: #dededd; color:#333; }
    .biao dt {border-bottom: 1px solid #333; font-size: smaller; }
    .biao dt, .biao dd { text-align: center;  }
    #top_biao_1 {position: absolute; top: 190px; left: 568px;}
    #top_biao_2 {position: absolute; top: 190px; left: 736px;}
    #left {width: 300px; float: left;}
    #sys_info { padding: 0 10px 10px 10px;  border: 1px solid #bec6d1; border-radius: 10px; }
    #sys_info dt, #sys_info dd {display: inline-block; line-height: 30px; font-size: 14px;}
    #sys_info dl {margin-top: 5px;}
    #sys_info dt {width: 100px;}
    #sys_info dd { background-color: #dededd; width: 100px; color:#508c8c; padding-left: 15px; border-radius: 3px; font-size: 18px; }
    #sys_info dd.stwo {background-color: #c2c1c1;}
    #right {width: 700px; float: left; margin-left: 30px;}
    #level {float: left; width: 110px;height:180px; border: 1px solid #bec6d1; border-radius: 10px;font-size: 14px;padding: 0 10px 10px 10px; }
    #level_txt {float: left; padding-top:20px;line-height:39px;}
    #level_center {float: left; background-color: #fff; width: 50px; margin-left: 10px; height: 184px; font-size: 12px; color:#000; text-align:center;}
    #level_center img {padding-top: 2px;}
    #level_right { float: left; padding-top:20px; line-height: 24px; width: 10px; padding-left: 10px; }
    #temperature { float:left; padding: 0 10px 10px 10px; border: 1px solid #bec6d1; border-radius: 10px; width: 350px; height: 180px; margin-left: 30px; }
    #zhizhen {position: absolute; top: 190px; left: 418px;}
    #jieneng {  border: 1px solid #bec6d1; border-radius: 10px;margin-top: 20px; height: 500px;}
    .col {width:33%;border-right: 1px solid #bec6d1; height: 100%; }
    .col .tit {font-size:14px; line-height: 40px; text-align: center;}
    .col .txt { margin-left: 5px; padding: 3px 0; }
    .clear {clear: both;}
    .bt_txt{line-height: 50px;text-align:center; font-size:14px;}
    .jn_txt{background-color:#dededc; width: 100%; height: 30px; margin-top:34px; color:#000; line-height: 30px; text-align:center; font-size:14px;}
    #tab {width: 700px;padding: 10px; border: 1px solid #bec6d1; border-radius: 10px;margin-top: 20px; height: 480px;}
    section input, section label {display: inline-block;}
    .panels, .panel {background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/tab.jpg') repeat-x;}
    #sys_info dd.dw { width:40px;background:none;font-size: 14px;color: #000; }
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>实时能效比</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>

  <div class="content">

        <div id="left" >

            <div id="sys_info">
                <dl>
                    <dt>系统总功耗</dt>
                    <dd id="RealPower"><span>0.00</span></dd>
                    <dd class="dw">kW/h</dd>
                </dl>
                <dl>
                    <dt>总制冷量</dt>
                    <dd class="stwo" id="DayCooling"><span>7.00</span></dd>
                    <dd class="dw">kW/h</dd>
                </dl>
                <dl>
                    <dt>总耗电量</dt>
                    <dd id="DayEnergy"><span>90.00</span></dd>
                    <dd class="dw">kW/h</dd>
                </dl>
                <dl>
                    <dt>总运行时间</dt>
                    <dd class="stwo" id="TotalTime"><span>0.00</span></dd>
                    <dd class="dw">小时</dd>
                </dl>
                <dl>
                    <dt>开机时间</dt>
                    <dd id="StartTime">&nbsp;</dd>
                    <dd class="dw">&nbsp;</dd>
                </dl>
            </div>


            <div id="jieneng">
                <div class="col fl">
                    <p class="tit">能耗节约</p>
                    <div style="padding-left: 10px;">
                        <div class="fl">
                            <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/yz_jieneng.jpg" >
                        </div>
                        <p class="fl txt">8000</p>
                        <p class="fl txt">5000</p>
                        <p class="fl txt">2000</p>
                        <p class="fl txt">1000</p>
                        <p class="fl txt">500</p>
                        <p class="fl txt">100</p>
                    </div>
                    <p class="tit clear">当前(kW/h)</p>
                    <div class="fl jn_txt">&nbsp;</div>
                    <p class="tit clear">当天</p>
                    <div class="fl jn_txt" id="SavedEnergyD">0.00</div>
                    <p class="tit clear">当月</p>
                    <div class="fl jn_txt" id="SavedEnergyM">0.00</div>
                    <p class="tit clear">当年</p>
                    <div class="fl jn_txt" id="SavedEnergyY">0.00</div>
                    <p class="bt_txt">kW/h Saved</p>
                </div>


                <div class="col fl">
                    <p class="tit">减排二氧化碳</p>
                    <div style="padding-left: 10px;">
                        <div class="fl">
                            <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/yz_jieneng.jpg" >
                        </div>
                        <p class="fl txt">8000</p>
                        <p class="fl txt">5000</p>
                        <p class="fl txt">2000</p>
                        <p class="fl txt">1000</p>
                        <p class="fl txt">500</p>
                        <p class="fl txt">100</p>
                    </div>
                    <p class="tit clear">当前(千克)</p>
                    <div class="fl jn_txt">&nbsp;</div>
                    <p class="tit clear">当天</p>
                    <div class="fl jn_txt" id="SavedCO2DD">0.00</div>
                    <p class="tit clear">当月</p>
                    <div class="fl jn_txt" id="SavedCO2DM">0.00</div>
                    <p class="tit clear">当年</p>
                    <div class="fl jn_txt" id="SavedCO2DY">0.00</div>
                    <p class="bt_txt">Co2 Saved</p>
                </div>


                <div class="col fl" style="border:none;">
                    <p class="tit">节省费用</p>
                    <div style="padding-left: 10px;">
                        <div class="fl">
                            <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/yz_jieneng.jpg" >
                        </div>
                        <p class="fl txt">8000</p>
                        <p class="fl txt">5000</p>
                        <p class="fl txt">2000</p>
                        <p class="fl txt">1000</p>
                        <p class="fl txt">500</p>
                        <p class="fl txt">100</p>
                    </div>
                    <p class="tit clear">当前(元)</p>
                    <div class="fl jn_txt">&nbsp;</div>
                    <p class="tit clear">当天</p>
                    <div class="fl jn_txt" id="SavedMoneyD">0.00</div>
                    <p class="tit clear">当月</p>
                    <div class="fl jn_txt" id="SavedMoneyM">0.00</div>
                    <p class="tit clear">当年</p>
                    <div class="fl jn_txt" id="SavedMoneyY">0.00</div>
                    <p class="bt_txt">￥ Saved</p>
                </div>

            </div>

        </div>


        <div id="right">

            <div id="level">

                <div id="level_txt">
                    <p style="color:#fa0612;">较差</p>
                    <p style="color:#ed9f17;">中等</p>
                    <p style="color:#efe901;">良好</p>
                    <p style="color:#3dad3f;">优秀</p>
                </div>

                <div id="level_center">
                    <p><span>0.00</span></p>
                    <p>
                        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/seka.jpg" >
                    </p>
                </div>

                <div id="level_right">

                    <p>1</p>
                    <p>2</p>
                    <p>3</p>
                    <p>4</p>
                    <p>5</p>
                    <p>6</p>
                    <p>7</p>

                </div>

                <span id="zhizhen"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/seka_arrow.png"></span>

            </div>

            <div id="temperature">

                <div id="c_one" style="width: 170px;height:170px;"></div>
                <dl id="top_biao_1" class="biao">
                    <dt><em>0.00</em>&nbsp;°C</dt>
                    <dd>室外空气温度</dd>
                </dl>

                <div id="c_two" style="width: 170px;height:170px;"></div>
                <dl id="top_biao_2" class="biao">
                    <dt><em>0.00</em>&nbsp;%</dt>
                    <dd>室外空气湿度</dd>
                </dl>

            </div>


            <div id="tab" class="fl">
                <article class="tabs">

                    <input checked id="one" name="tabs" type="radio">
                    <label for="one">实时COP</label>

                    <input id="two" name="tabs" type="radio" value="Two">
                    <label for="two">实时功率</label>

                    <input id="three" name="tabs" type="radio">
                    <label for="three">节能量</label>

                    <input id="four" name="tabs" type="radio">
                    <label for="four">室外温度</label>

                    <input id="five" name="tabs" type="radio">
                    <label for="five">室外湿度</label>

                    <input id="six" name="tabs" type="radio">
                    <label for="six">冷冻供回水</label>

                    <input id="seven" name="tabs" type="radio">
                    <label for="seven">冷却供回水</label>

                    <input id="eight" name="tabs" type="radio">
                    <label for="eight">冷冻/却水流量</label>


                    <div class="panels">

                        <div class="panel">
                            <div id="cop_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="Power_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="SavedEnergy_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="OTem_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="OHum_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="Lds_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="Lqs_chart" style="height:440px;width:100%;"></div>
                        </div>

                        <div class="panel">
                            <div id="Sflow_chart" style="height:440px;width:100%;"></div>
                        </div>

                    </div>

                </article>
            </div>

        </div>


        <div id="zhu_red" style="position: absolute; top: 481px; left: 33px; width: 46px; height:0px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/zhu_red.jpg') repeat-y;">
          &nbsp;
            <!-- 
              <100 top: 476px;height:5px; 
              100 top: 466px;height:15px;
              500 top: 440px;height:41px;
              1000 top: 414px;height:67px;
            -->
        </div>
        <div id="zhu_blue" style="position: absolute; top: 476px; left: 132px; width: 46px; height:0px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/zhu_blue.jpg') repeat-y;">
          &nbsp;
        </div>
        <div id="zhu_yellow" style="position: absolute; top: 414px; left: 232px; width: 45px; height:0px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/zhu_yellow.jpg') repeat-y;">
          &nbsp;
        </div>
  </div>

</div>

<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/echarts.min.js"></script>
<script>
//仪表盘
option_gauge = {
    backgroundColor: '',
    tooltip: {
        show: true,
        formatter: "{a}{b}：{c}",
        backgroundColor: '#6eba44',
        borderColor: 'red',
        borderWidth: '1px',
        textStyle: {
            color: 'white'
        }
    },
    series: [{
        name: '能力',
        type: 'gauge',
        // startAngle: 180,
        // endAngle: 0,
        splitNumber: 4, //刻度数量
        min: 0,
        max: 1800,
        radius: '65%', //图表尺寸
        zlevel: 10,
        axisLine: {
            show: true,
            lineStyle: {
                width: 3,
                color: [
                    [0.2, '#333'],
                    [0.8, '#333'],
                    [1, '#333']
                ]
            }
        },
        axisTick: {
            show: true,
            lineStyle: {
                color: "#333",
                width: 1
            },
            length: 8,
            splitNumber: 2
        },
        splitLine: {
            show: true,
            length: 10,
            lineStyle: {
                color: '#333'
            }
        },
        axisLabel: {
            distance: 4,
            textStyle: {
                color: "#333",
                fontSize: "14",
            },
            formatter: function(e) {
                switch (e + "") {
                    case "0":
                        return "0";
                    case "10":
                        return "10";
                    case "20":
                        return "20";
                    case "30":
                        return "30";
                    case "40":
                        return "40";
                    case "50":
                        return "50";
                    case "60":
                        return "60";
                    case "70":
                        return "70";
                    case "80":
                        return "80";
                    case "90":
                        return "90";
                    default:
                        return e;
                }
            }
        },
        pointer: {
            show: true,
            width:2
        },
        itemStyle: { //仪表盘指针样式
            normal: {
                color: 'red',
                shadowColor: 'rgba(0, 0, 0, 0.5)',
                shadowBlur: 2,
                borderWidth:0,
                shadowOffsetX: 1,
                shadowOffsetY: 1
            }
        },
        detail: { //指针评价
            show: false,
            offsetCenter: [0, 40],
            textStyle: {
                fontSize: 8,
                color: "#333"
            },
        },
        title: {
            textStyle: {
                fontSize: 8,
                fontWeight: 'normal',
                fontStyle: 'normal',
                color: "#333"
            },
            offsetCenter: [0, 15]
        },
        data: [{
            name: "",
            value: 0
        }]
    },{
        name: '白色背景',
        type: 'gauge',
        radius: '60%',
        startAngle: 359.9,
        endAngle: 0,
        splitNumber: 4,
        zlevel: 1,
        axisLine: { // 坐标轴线
            lineStyle: { // 属性lineStyle控制线条样式
                color: [
                    [1, '#fff']
                ],
                width: '100%',
                shadowOffsetX: 0,
                shadowOffsetY: 0,
                opacity: 1,
            }

        },
        splitLine: { //分隔线样式
            show: false,
        },
        axisLabel: { //刻度标签
            show: false,
        },
        axisTick: { //刻度样式
            show: false,
        },
        detail:{
            show: false,
        },
        data: [{
            show: false,
        }]
    },{
        name: '灰色背景',
        type: 'gauge',
        startAngle: 359.9,
        endAngle: 0,
        splitNumber: 4, //刻度数量
        min: 0,
        max: 1800,
        radius: '60%', //图表尺寸
        zlevel: 11,
        axisLine: {
            show: true,
            lineStyle: {
                width: 7,
                color: [
                    [0.2, '#656363'],
                    [0.8, '#656363'],
                    [1, '#656363']
                ],
                opacity: .5,
            }
        },
        splitLine: { //分隔线样式
            show: false,
        },
        axisLabel: { //刻度标签
            show: false,
        },
        axisTick: { //刻度样式
            show: false,
        },
        detail:{
            show: false,
        },
        data: [{
            show: false,
        }]
    }]
};

//获取温度、湿度
$(function(){
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getCurState",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {},
        success: function (t) {
            var EnvState = t.EnvState ;
            //console.log(EnvState);

            //室外温度
            option_gauge.series[0].min = -10;
            option_gauge.series[0].max = 50;
            var chart_c_one = echarts.init(document.getElementById('c_one'));//电流表A
            var value_c_one = EnvState.OTem; //能力值取代码置于值于此处
            $("#top_biao_1 dt em").html(value_c_one);
            option_c_one = option_gauge ;
            option_c_one.series[0].data[0].value = Math.floor(value_c_one) ;
            // 使用刚指定的配置项和数据显示图表。
            chart_c_one.setOption(option_c_one);

            //室外湿度
            option_gauge.series[0].min = 0;
            option_gauge.series[0].max = 100;
            var chart_c_two = echarts.init(document.getElementById('c_two'));//电流表A
            var value_c_two = EnvState.OHum; //能力值取代码置于值于此处
            $("#top_biao_2 dt em").html(value_c_two);
            option_c_two = option_gauge ;
            option_c_two.series[0].data[0].value = Math.floor(value_c_two) ;
            // 使用刚指定的配置项和数据显示图表。
            chart_c_two.setOption(option_c_two);

            //系统状态
            var SystemState = t.SystemState ;
            $("#RealPower span").html(SystemState.RealPower);//系统总功耗
            $("#DayCooling span").html(SystemState.DayCooling);//总制冷量
            $("#DayEnergy span").html(SystemState.DayEnergy);//总耗电量
            $("#TotalTime span").html(SystemState.TotalTime);//总运行时间
            $("#StartTime").html(new Date(parseInt(SystemState.StartTime) * 1000).toLocaleTimeString().replace(/^\D*/, ''));//开机时间

            //COP指针
            var avgCop = SystemState.AvgCOP;
            $("#level_center span").html(avgCop);
            if( avgCop <= 1 ) {
                $("#zhizhen").css("top","100px");
            }
            if( avgCop >= 7 ) {
                $("#zhizhen").css("top","244px");
            }
            if( avgCop > 1 && avgCop < 7 ) {
                var pos = (avgCop - 1)/6 * 144 + 100;
                $("#zhizhen").css( "top", pos + "px" );
            }

            //节能数据
            $("#SavedEnergyD").html(SystemState.SavedEnergyD);//系统节省电量，当天
            $("#SavedEnergyM").html(SystemState.SavedEnergyM);//系统节省电量，当月
            $("#SavedEnergyY").html(SystemState.SavedEnergyY);//系统节省电量，当年
            $("#SavedCO2DD").html(SystemState.SavedCO2DD);//系统CO2减排量，当天
            $("#SavedCO2DM").html(SystemState.SavedCO2DM);//系统CO2减排量，当月
            $("#SavedCO2DY").html(SystemState.SavedCO2DY);//系统CO2减排量，当年
            $("#SavedMoneyD").html(SystemState.SavedMoneyD);//系统节省费用，当天
            $("#SavedMoneyM").html(SystemState.SavedMoneyM);//系统节省费用，当天
            $("#SavedMoneyY").html(SystemState.SavedMoneyY);//系统节省费用，当天
            //节能柱状动态图
            pos_energy = getZhuPos(SystemState.SavedEnergyD);
            $("#zhu_red").css("top",pos_energy[0] + "px");
            $("#zhu_red").css("height", pos_energy[1] + "px");
            console.log(SystemState.SavedCO2DD);
            pos_co2 = getZhuPos(SystemState.SavedCO2DD);
            console.log(pos_co2);
            $("#zhu_blue").css("top",pos_co2[0] + "px");
            $("#zhu_blue").css("height", pos_co2[1] + "px");
            pos_money = getZhuPos(SystemState.SavedMoneyD);
            $("#zhu_yellow").css("top",pos_money[0] + "px");
            $("#zhu_yellow").css("height", pos_money[1] + "px");

            /** 实时曲线图开始 **/
            var Copdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                value: [SystemState.CurCOP]
            };
            var Powerdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                value: [SystemState.RealPower]
            };
            var SavedEnergydata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                value: [SystemState.SavedEnergyD]
            }
            var OTemdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                value: [EnvState.OTem]
            };
            var OHumdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                value: [EnvState.OHum]
            };
            var Ldsdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                val1: [EnvState.TemACE1],
                val2: [EnvState.TemACE2]
            }
            var Lqsdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                val1: [EnvState.TemACE3],
                val2: [EnvState.TemACE4]
            }
            var Sflowdata = {
                column: [ (new Date()).toLocaleTimeString().replace(/^\D*/, '')],
                val1: [EnvState.LDSFlow],
                val2: [EnvState.LQSFlow]
            }

            // 基于准备好的dom，初始化echarts实例
            var copChart = echarts.init(document.getElementById('cop_chart'), 'walden');
            var PowerChart = echarts.init(document.getElementById('Power_chart'), 'walden');
            var SavedEnergyChart = echarts.init(document.getElementById('SavedEnergy_chart'), 'walden');
            var OTemChart = echarts.init(document.getElementById('OTem_chart'), 'walden');
            var OHumChart = echarts.init(document.getElementById('OHum_chart'), 'walden');
            var LdsChart = echarts.init(document.getElementById('Lds_chart'), 'walden');
            var LqsChart = echarts.init(document.getElementById('Lqs_chart'), 'walden');
            var SflowChart = echarts.init(document.getElementById('Sflow_chart'), 'walden');

            // 指定图表的配置项和数据
            var option = {
                title: {
                    text: '',
                    subtext: ''
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ["值"]
                },
                toolbox: {
                    show: false,
                    feature: {
                        magicType: {show: true, type: ['stack', 'tiled']},
                        saveAsImage: {show: true}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: Copdata.column
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: {
                        show: false
                    }
                },
                grid: [{
                        left: '50',
                        top: '20',
                        right: '30',
                        bottom: 30
                    }],
                series: [{
                        name: "值",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Copdata.value
                    }]
            };

            // 使用刚指定的配置项和数据显示图表。
            copChart.setOption(option);
            PowerChart.setOption(option);
            SavedEnergyChart.setOption(option);
            OTemChart.setOption(option);
            OHumChart.setOption(option);
            var LdsOption = {
                title: {
                    text: '',
                    subtext: ''
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ["冷冻水供水", "冷冻水回水"]
                },
                toolbox: {
                    show: false,
                    feature: {
                        magicType: {show: true, type: ['stack', 'tiled']},
                        saveAsImage: {show: true}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: Copdata.column
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: {
                        show: false
                    }
                },
                grid: [{
                        left: '50',
                        top: '20',
                        right: '30',
                        bottom: 30
                    }],
                series: [{
                        name: "冷冻水供水",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Ldsdata.val1
                    },{
                        name: "冷冻水回水",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Ldsdata.val2
                    }]
            };
            LdsChart.setOption(LdsOption);
            var LqsOption = {
                title: {
                    text: '',
                    subtext: ''
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ["冷却水供水", "冷却水回水"]
                },
                toolbox: {
                    show: false,
                    feature: {
                        magicType: {show: true, type: ['stack', 'tiled']},
                        saveAsImage: {show: true}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: Copdata.column
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: {
                        show: false
                    }
                },
                grid: [{
                        left: '50',
                        top: '20',
                        right: '30',
                        bottom: 30
                    }],
                series: [{
                        name: "冷却水供水",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Lqsdata.val1
                    },{
                        name: "冷却水回水",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Lqsdata.val2
                    }]
            };
            LqsChart.setOption(LqsOption);
            var SflowOption = {
                title: {
                    text: '',
                    subtext: ''
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ["冷冻水总流量", "冷却水总流量"]
                },
                toolbox: {
                    show: false,
                    feature: {
                        magicType: {show: true, type: ['stack', 'tiled']},
                        saveAsImage: {show: true}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: Copdata.column
                },
                yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: {
                        show: false
                    }
                },
                grid: [{
                        left: '50',
                        top: '20',
                        right: '30',
                        bottom: 30
                    }],
                series: [{
                        name: "冷冻水总流量",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Sflowdata.val1
                    },{
                        name: "冷却水总流量",
                        type: 'line',
                        smooth: true,
                        // areaStyle: {
                        //     normal: {
                        //     }
                        // },
                        lineStyle: {
                            normal: {
                                width: 1.5
                            }
                        },
                        data: Sflowdata.val2
                    }]
            };
            SflowChart.setOption(SflowOption);

            //动态添加数据，可以通过Ajax获取数据然后填充
            setInterval(function () {

                $(function(){
                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getCurState",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {},
                        success: function (t) {
                            //实时COP
                            setOpt(Copdata, copChart, t.SystemState.CurCOP);
                            //实时功率
                            setOpt(Powerdata, PowerChart, t.SystemState.RealPower);
                            //节能量
                            setOpt(SavedEnergydata, SavedEnergyChart, t.SystemState.SavedEnergyD);
                            //室外温度
                            setOpt(OTemdata, OTemChart, t.EnvState.OTem);
                            //室外湿度
                            setOpt(OHumdata, OHumChart, t.EnvState.OHum);
                            //冷冻水供回水
                            Ldsdata.column.push((new Date()).toLocaleTimeString().replace(/^\D*/, ''));
                            Ldsdata.val1.push( t.EnvState.TemACE1 );
                            Ldsdata.val2.push( t.EnvState.TemACE2 );
                            setOptTwo(Ldsdata, LdsChart);
                            //冷却水供回水
                            Lqsdata.column.push((new Date()).toLocaleTimeString().replace(/^\D*/, ''));
                            Lqsdata.val1.push( t.EnvState.TemACE3 );
                            Lqsdata.val2.push( t.EnvState.TemACE4 );
                            setOptTwo(Lqsdata, LqsChart);
                            //冷冻水冷却水总流量
                            Sflowdata.column.push((new Date()).toLocaleTimeString().replace(/^\D*/, ''));
                            Sflowdata.val1.push( t.EnvState.LDSFlow );
                            Sflowdata.val2.push( t.EnvState.LQSFlow );
                            setOptTwo(Sflowdata, SflowChart);
                        }
                    });
                });
                
            }, 3000);
            /** 实时曲线图结束 **/
        }
    });
});

function setOpt(data, chart, value) {
    data.column.push((new Date()).toLocaleTimeString().replace(/^\D*/, ''));
    data.value.push( value );
    if (data.column.length >= 20) {
        //移除最开始的一条数据
        data.column.shift();
        data.value.shift();
    }
    chart.setOption({
        xAxis: {
            data: data.column
        },
        series: [{
                name: "值",
                data: data.value
            }]
    });
}

function setOptTwo(data, chart) {
    
    if (data.column.length >= 20) {
        //移除最开始的一条数据
        data.column.shift();
        data.val1.shift();
        data.val2.shift();
    }
    chart.setOption({
        xAxis: {
            data: data.column
        },
        series: [{
                name: "值1",
                data: data.val1
            },{
                name: "值2",
                data: data.val2
            }]
    });
}

//根据节能值获取高度宽度定位值
/*<100 top: 476px;height:5px; 
100 top: 466px;height:15px;
500 top: 440px;height:41px;
1000 top: 414px;height:67px;*/
function getZhuPos(val) {
    var top = 481;
    var height = 0;
    if( val > 0 && val < 100 ) {
        top = 475;
        height = 5;
    }
    if( val == 100 ) {
        top = 466;
        height = 15;
    }
    if( val > 100 && val < 500 ) {
        var ratio = (val - 100) / (500 - 100) ;
        var shift = ratio * 26; //偏移量
        top = 466 - shift ;
        height = 15 + shift ;
    }
    if( val == 500 ) {
        top = 440;
        height = 41;
    }
    if( val > 500 && val < 1000 ) {
        var ratio = (val - 500) / (1000 - 500) ;
        var shift = ratio * 26;//偏移量
        top = 440 - shift ;
        height = 41 + shift ;
    }
    if( val == 1000 ) {
        top = 414;
        height = 67;
    }
    if( val > 1000 && val < 2000 ) {
        var ratio = (val - 1000) / (2000 - 1000) ;
        var shift = ratio * 26;//偏移量
        top = 414 - shift ;
        height = 67 + shift ;
    }
    if( val == 2000 ) {
        top = 388;
        height = 93;
    }
    if( val > 2000 && val < 5000 ) {
        var ratio = (val - 2000) / (5000 - 2000) ;
        var shift = ratio * 26;//偏移量
        top = 388 - shift ;
        height = 93 + shift ;
    }
    if( val == 5000 ) {
        top = 362;
        height = 119;
    }
    if( val > 5000 && val < 8000 ) {
        var ratio = (val - 5000) / (8000 - 5000) ;
        var shift = ratio * 26;//偏移量
        top = 362 - shift ;
        height = 119 + shift ;
    }
    if( val >= 8000 ) {
        top = 330;
        height = 151;
    }
    return [top, height] ;
}

</script>