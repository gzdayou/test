<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body { color: #fff; }
    .fixed-bar {padding-bottom: 8px;}
    .content{ width: 100%; height: 838px; /**background-color: #0c6295;**/ background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .page { padding: 62px 0 0 1%; }
    .first_line { width: 1272px; color: #fff; border-bottom: 1px #5e99b7 solid; }
    .controll { width: 80px; border-right: 1px #5e99b7 solid; float: left;  }
    .controll dl dt { border-bottom: 1px #5e99b7 solid; }
    .controll dl dt span { width: 100%; text-align: center; margin: 0 auto ; }
    .controll dl dt span img { display: block; margin: 10px 0 10px 27px; }
    .controll dl em { width : 100%; text-align: center; margin: 0 auto; display: block; font-size: 16px; }
    .controll dl dd span img { display: block; margin: 10px 0 10px 27px; }
    .controll a {color: #fff;}
    .c_power { float:left; width: 300px; border-right: 1px #5e99b7 solid; height: 135px; }
    .c_power p { width: 100%; font-size: 48px;  padding-left: 50px; margin-top: 20px; }
    .c_power div { width: 100%; font-size: 14px; text-align: right;  }
    .c_power div span { padding-right: 20px; }
    #c_one,#c_two,#c_three, #t_one, #t_two, #t_three { float: left; }
    .second_line { width: 806px; text-align: center; height: 520px; border-bottom: 1px solid #5e99b7; }
    .second_line p { height: 100px; line-height: 100px; font-size: 28px; color: #fff;}
    .third_line { height: 180px; }
    .alarm { width: 80px; color: #fff; font-size: 16px; float: left; border-right: 1px solid #5e99b7; height: 180px;}
    .des, .des div { float: left; }
    .des { width: 300px; border-right: 1px #5e99b7 solid; height: 180px; }
    .des .color1, .des .color2, .des .color3, .des .color4 { width: 300px; float: left;  }
    .bg {width: 180px; border-radius: 5px; margin-left: 20px; }
    .color1 .bg { background-color: #6868ff; }
    .color2 .bg { background-color: #85b0d8; }
    .color3 .bg { background-color: #6ae675; }
    .color4 .bg { background-color: #194d26; }
    .des span { font-size: 12px; margin-left: 30px; }
    .p_right div {position: absolute; left: 875px; background:url('<?php echo ADMIN_RESOURCE_URL;?>/image/data_bg.png') no-repeat;
        width: 190px; height: 37px; font-size: 14px;line-height: 37px; color: #fff; padding: 0 0 0 10px;}
    .p_right .p1 { top: 220px; }
    .p_right .p2 { top: 270px; }
    .p_right .p3 { top: 320px; }
    .p_right .p4 { top: 370px; }
    .p_right .p5 { top: 420px; }
    .p_right .p6 { top: 470px; }
    .p_right span { margin-left: 10px; position: absolute;background: url(<?php echo ADMIN_RESOURCE_URL;?>/image/data_bg.png) no-repeat;width: 100px;height: 37px;font-size: 14px; font-weight:bold;line-height: 37px;color: #fff;padding: 0 0 0 10px; }
    .biao { border : 1px solid #333; width: 66px; border-radius : 3px; background-color: #dededd; color:#333; }
    .biao dt {border-bottom: 1px solid #333; font-size: smaller; }
    .biao dt, .biao dd { text-align: center;  }
    #top_biao_1 {position: absolute; top: 154px; left: 427px;}
    #top_biao_2 {position: absolute; top: 154px; left: 562px;}
    #top_biao_3 {position: absolute; top: 154px; left: 697px;}
    #bot_biao_1 {position: absolute; top: 810px; left: 427px;}
    #bot_biao_2 {position: absolute; top: 810px; left: 562px;}
    #bot_biao_3 {position: absolute; top: 810px; left: 697px;}
    #wheel {position: absolute; top: 346px; left: 338px;}
    #light {position: absolute; top: 359px; left: 250px;}
    #host_status {position: absolute; top: 352px; left: 385px;}
    .alarm dt { padding: 50px 0 0 15px; }
    .alarm dd { padding: 10px 0 0 12px; font-size: 13px; }
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#fff;
        border-width: 1px;
        border-color: #5e99b7;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #5e99b7;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #5e99b7;
        /* background-color: #ffffff; */
    }
    table.gridtable td.col_one {background-color : #0070c0; color: #fff; font-size: 14px;width: 112px;}
    table.gridtable td.col_two { color: rgba(242,242,242,1); font-size: 20px; width: 84px;}
    table.gridtable td.col_three { color: #000; font-size: 14px;}
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷源主机</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>

  <div class="content">
      <div class="first_line">
		<!-- 开关BEGIN -->
		<div class="controll">
			<dl>
				<dt><a href="javascript:;" onclick="turn(1);">
					<span><img alt="" src="<?php echo ADMIN_RESOURCE_URL;?>/image/host_btn_on.png"></span>
					<em>运行</em></a>
				</dt>
				<dd><a href="javascript:;" onclick="turn(2);">
					<span><img alt="" src="<?php echo ADMIN_RESOURCE_URL;?>/image/host_btn_off.png"></span>
					<em>停止</em></a>
				</dd>
			</dl>
		</div>
		<!-- 开关END -->
		
		<!-- 第一行中间文字BEGIN -->
		<div class="c_power">
			<p id="CurPower">
				
			</p>
			<div><span>( kW/h )实时功率</span></div>
		</div>
		<!-- 第一行中间文字END -->
		
		<!-- 仪表BEGIN -->
		
		<div id="c_one" style="width: 135px;height:135px;">
		</div>

        <div id="c_two" style="width: 135px;height:135px;">
        </div>

        <div id="c_three" style="width: 135px;height:135px;">
        </div>
        
        <dl id="top_biao_1" class="biao">
        	<dt>0.00</dt>
        	<dd>电流表A相</dd>
        </dl>
        <dl id="top_biao_2" class="biao">
        	<dt>0.00</dt>
        	<dd>电流表B相</dd>
        </dl>
        <dl id="top_biao_3" class="biao">
        	<dt>0.00</dt>
        	<dd>电流表C相</dd>
        </dl>
		
		<!-- 仪表END -->
		
		<div style="clear: both;"></div>
      </div>


      <div class="second_line">
            <p>主机机组<?php echo $output['idx']+1; ?></p>
            <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/Host_BG.png" >
            
            <!-- 冷冻水供水开始 -->
            <div style="position: absolute; border: 10px #85b0d8 solid; top: 334px; left: 130px; border-right: none; border-top: none; width: 60px; height: 100px;">
                &nbsp;
            </div>
            <div style="position: absolute; top: 320px; left: 120px; width: 0; height: 0; border-left: 15px solid transparent; border-right: 15px solid transparent; border-bottom: 15px solid #85b0d8; font-size: 0; line-height: 0; ">&nbsp;</div>
            <div id="lds_g" style="position: absolute; top: 260px; left: 74px;border: 2px solid #85b0d8; width: 120px; height: 50px; border-radius: 5px; color: #fff; font-size: 20px; line-height: 50px; " >7.4 &#8451;</div>
            <!-- 冷冻水供水结束 -->

            <!-- 冷冻水回水开始 -->
            <div style="position: absolute; border: 10px #6868ff solid; top: 464px; left: 120px; border-right: none; border-bottom: none; width: 60px; height: 100px;">
                &nbsp;
            </div>
            <div style="position: absolute; top: 456px; left: 190px; width: 0; height: 0; border-bottom: 15px solid transparent; border-top: 15px solid transparent; border-left: 15px solid #6868ff; font-size: 0; line-height: 0; ">&nbsp;</div>
            <div id="lds_h" style="position: absolute; top: 580px; left: 64px;border: 2px solid #6868ff; width: 120px; height: 50px; border-radius: 5px; color: #fff; font-size: 20px; line-height: 50px; " >7.4 &#8451;</div>
            <!-- 冷冻水回水结束 -->

            <!-- 冷却水供水开始 -->
            <div style="position: absolute; border: 10px #194d26 solid; top: 320px; left: 630px; border-left: none; border-top: none; width: 60px; height: 60px;">
                &nbsp;
            </div>
            <div style="position: absolute; top: 310px; left: 680px; width: 0; height: 0; border-left: 15px solid transparent; border-right: 15px solid transparent; border-bottom: 15px solid #194d26; font-size: 0; line-height: 0; ">&nbsp;</div>
            <div id="lqs_g" style="position: absolute; top: 248px; left: 630px;border: 2px solid #194d26; width: 120px; height: 50px; border-radius: 5px; color: #fff; font-size: 20px; line-height: 50px; " >7.4 &#8451;</div>
            <!-- 冷却水供水结束 -->

            <!-- 冷冻水回水开始 -->
            <div style="position: absolute; border: 10px #6ae675 solid; top: 400px; left: 645px; border-left: none; border-bottom: none; width: 60px; height: 160px;">
                &nbsp;
            </div>
            <div style="position: absolute; top: 396px; left: 636px; font-size: 0; line-height: 0;  border-width: 10px;  border-color: #6ae675;  border-left-width: 0;  border-style: dashed;  border-right-style: solid;  border-top-color: transparent;  border-bottom-color: transparent;   ">&nbsp;</div>
            <div id="lqs_h" style="position: absolute; top: 580px; left: 650px;border: 2px solid #6ae675; width: 120px; height: 50px; border-radius: 5px; color: #fff; font-size: 20px; line-height: 50px; " >7.4 &#8451;</div>
            <!-- 冷冻水回水结束 -->

      </div>

      <div class="third_line">

          <div class="alarm">
              <dl>
                  <dt></dt>
                  <dd>故障报警</dd>
              </dl>
          </div>

          <div class="des"><br><br>
                <div class="color1">
                    <div class="bg">&nbsp;</div>
                    <span>冷冻水回水</span>
                </div><br><br>
                <div class="color2">
                    <div class="bg">&nbsp;</div>
                    <span>冷冻水供水</span>
                </div><br><br>
                  <div class="color3">
                      <div class="bg">&nbsp;</div>
                      <span>冷却水回水</span>
                  </div><br><br>
                  <div class="color4">
                      <div class="bg">&nbsp;</div>
                      <span>冷却水供水</span>
                  </div>

                <div style="clear: both;"></div>
          </div>

          <div id="t_one" style="width: 135px;height:135px;">
          </div>

          <div id="t_two" style="width: 135px;height:135px;">
          </div>

          <div id="t_three" style="width: 135px;height:135px;">
          </div>

          <div style="clear: both;"></div>
          
          <dl id="bot_biao_1" class="biao">
        	<dt>0.00</dt>
        	<dd>电压表A相</dd>
	        </dl>
	        <dl id="bot_biao_2" class="biao">
	        	<dt>0.00</dt>
	        	<dd>电压表B相</dd>
	        </dl>
	        <dl id="bot_biao_3" class="biao">
	        	<dt>0.00</dt>
	        	<dd>电压表C相</dd>
	        </dl>

      </div>


      <div class="p_right">
          <table class="gridtable" style="position: absolute; left: 817px;top: 197px;">
                <tr>
                    <td class="col_one">当日小计电量</td>
                    <td class="col_two" id="CurEnergy">&nbsp;</td>
                    <td class="col_three">kW/h</td>
                </tr>
                <tr>
                    <td class="col_one">当日小计时间</td>
                    <td class="col_two" id="CurTime">&nbsp;</td>
                    <td class="col_three">分钟</td>
                </tr>
                <tr>
                    <td class="col_one">总计运行电量</td>
                    <td class="col_two" id="TotalEnergy">&nbsp;</td>
                    <td class="col_three">kW/h</td>
                </tr>
                <tr>
                    <td class="col_one">总计运行时间</td>
                    <td class="col_two" id="TotalTime">&nbsp;</td>
                    <td class="col_three">分钟</td>
                </tr>
                <tr>
                    <td class="col_one">当天开机时间</td>
                    <td class="col_two" id="StartTime">&nbsp;</td>
                    <td class="col_three">&nbsp;</td>
                </tr>
                <tr>
                    <td class="col_one">当日关机时间</td>
                    <td class="col_two" id="StopTime">&nbsp;</td>
                    <td class="col_three">&nbsp;</td>
                </tr>
          </table>
      </div>

      <!-- 齿轮 -->
      <span id="wheel">
        
      </span>

      <!-- 状态灯 -->
        <span id="light">
            
        </span>

        <span id="host_status">
            <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/Host_NC.png" > -->
        </span>
      

      <div style="position: absolute; top: 20px; left: 816px;width:1px; height: 880px; border-right: 1px #5e99b7 solid;">&nbsp;</div>

      
  </div>

</div>

<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/echarts.min.js"></script>
<script>

option = {
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
                fontSize: "9",
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

//获取页面数据
$(function(){

    ajaxFunc();

    setInterval(ajaxFunc, <?php echo C("ajax_time"); ?>);

    function ajaxFunc() {
        $.ajax({
            url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getMsgObject",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {msg_name: "HostState"},
            success: function (t) {//console.log(t)
                if( t.status == 1 ) {
                    var idx = <?php echo $output['idx']; ?>;
                    
                    var HostInfo = t.data.MSGOBJ.HostState.HostInfo[idx][0] ;
                    //console.log(HostInfo);

                    $("#CurPower").html(HostInfo.CurPower > 0 ? HostInfo.CurPower.toFixed(1) : 0);

                    //供水回水数据显示
                    $("#lds_g").html(HostInfo.HostTem1.toFixed(1));
                    $("#lds_h").html(HostInfo.HostTem2.toFixed(1));
                    $("#lqs_g").html(HostInfo.HostTem3.toFixed(1));
                    $("#lqs_h").html(HostInfo.HostTem4.toFixed(1));

                    $("#CurEnergy").html(HostInfo.CurEnergy.toFixed(1));//当日累计电量
                    $("#CurTime").html(HostInfo.CurTime);//当日累计时间
                    $("#TotalEnergy").html(HostInfo.TotalEnergy.toFixed(0));//总计累计电量
                    $("#TotalTime").html(HostInfo.TotalTime);//当日累计时间
                    $("#StartTime").html(dateFtt("hh:mm:ss",HostInfo.StartTime));//当天开机时间
                    $("#StopTime").html(dateFtt("hh:mm:ss",HostInfo.StopTime));//当日关机时间

                    //运行状态
                    if( HostInfo.CurState & 1 ) {
                        $("#wheel").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host_Lf.gif" >');
                        $("#light").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/Host_YX.png" >');
                    } else {
                        $("#wheel").html("");
                        $("#light").html("");
                    }
                    //非控状态
                    // if( HostInfo.CurMode != 1 ) {
                    //     $("#host_status").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/Host_NC.png" >');
                    // }
                    //故障报警
                    if( HostInfo.CurState & 2 ) {
                        $(".alarm dt").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_alarm_error.png" >');
                        $("#host_status").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/Host_A.png" >');
                    } else {
                        $(".alarm dt").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_alarm_normal.png" >');
                        $("#host_status").html('');
                    }

                    //基于准备好的dom，初始化echarts实例
                    option.series[0].max = 1800;
                    var chart_c_one = echarts.init(document.getElementById('c_one'));//电流表A
                    var value_c_one = HostInfo.CurEleA; //能力值取代码置于值于此处
                    $("#top_biao_1 dt").html(value_c_one);
                    option_c_one = option ;
                    option_c_one.series[0].data[0].value = Math.floor(value_c_one) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_one.setOption(option_c_one);


                    //基于准备好的dom，初始化echarts实例
                    var chart_c_two = echarts.init(document.getElementById('c_two'));//电流表B
                    var value_c_two = HostInfo.CurEleB; //能力值取代码置于值于此处
                    $("#top_biao_2 dt").html(value_c_two);
                    option_c_two = option ;
                    option_c_two.series[0].data[0].value = Math.floor(value_c_two) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_two.setOption(option_c_two);


                    //基于准备好的dom，初始化echarts实例
                    var chart_c_three = echarts.init(document.getElementById('c_three'));//电流表C
                    var value_c_three = HostInfo.CurEleC; //能力值取代码置于值于此处
                    $("#top_biao_3 dt").html(value_c_three);
                    option_c_three = option ;
                    option_c_three.series[0].data[0].value = Math.floor(value_c_three) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_three.setOption(option_c_three);


                    /** 电压表开始 **/

                    option.series[0].max = 600;
                    //基于准备好的dom，初始化echarts实例
                    var chart_t_one = echarts.init(document.getElementById('t_one'));//电压表A
                    var value_t_one = HostInfo.CurVolA; //能力值取代码置于值于此处
                    $("#bot_biao_1 dt").html(value_t_one);
                    option_t_one = option ;
                    option_t_one.series[0].data[0].value = Math.floor(value_t_one) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_t_one.setOption(option_t_one);


                    //基于准备好的dom，初始化echarts实例
                    var chart_t_two = echarts.init(document.getElementById('t_two'));//电压表B
                    var value_t_two = HostInfo.CurVolB; //能力值取代码置于值于此处
                    $("#bot_biao_2 dt").html(value_t_two);
                    option_t_two = option ;
                    option_t_two.series[0].data[0].value = Math.floor(value_t_two) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_t_two.setOption(option_t_two);


                    //基于准备好的dom，初始化echarts实例
                    var chart_t_three = echarts.init(document.getElementById('t_three'));//电压表C
                    var value_t_three = HostInfo.CurVolC; //能力值取代码置于值于此处
                    $("#bot_biao_3 dt").html(value_t_three);
                    option_t_three = option ;
                    option_t_three.series[0].data[0].value = Math.floor(value_t_three) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_t_three.setOption(option_t_three);

                } else {
                    //alert("ZMQ数据获取出错");
                }
            }
        });
    }
});


function turn( flag ) {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    var idx = parseInt(<?php echo $output['idx']; ?>) + parseInt(1);
    var commond = "SWITCH_HOST" + idx;

    var ctl = (flag == 1) ? "运行" : "停止";
    var msg = '确认'+ ctl +'主机'+idx+'吗？';

    layer.alert(msg, 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "冷源主机启停",
            yes:function(index){
                $.ajax({
                    url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                    type: "get",
                    timeout : 500,
                    dataType: "json",
                    data: {msg_name: commond, msg_value : flag},
                    success: function (t) {console.log(t)
                        if( t.status == '1' ) {
                        } else {
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('没有操作权限');
                    }
                });
                layer.close(index);
            },
            btn2:function(){
                return ;
            }
        }
    );

}

</script>