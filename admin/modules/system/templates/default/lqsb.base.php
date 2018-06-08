<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body { color: #fff; }
    .content{ width: 100%; height: 838px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .page { padding: 62px 0 0 1%; }
    .fixed-bar {padding-bottom: 8px;}
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
    .second_line p { color: #fff;}
    .third_line { height: 180px; }
    .alarm { width: 80px; color: #fff; font-size: 16px; float: left; border-right: 1px solid #5e99b7; height: 180px;}
    .des, .des div { float: left; }
    .des { width: 300px; border-right: 1px #5e99b7 solid; height: 180px; }
    .des .color1, .des .color2, .des .color3, .des .color4 { width: 300px; float: left;  }
    .bg {width: 180px; border-radius: 5px; margin-left: 20px; }
    .color1 .bg { background-color: #7ac48c;  }
    .color2 .bg { background-color: #00923f; }
    .color3 .bg { background-color: #76c5f0; }
    .color4 .bg { background-color: #1f567c; }
    .des span { font-size: 14px; margin-left: 30px; }
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
    #top_biao_1 {position: absolute; top: 160px; left: 427px;}
    #top_biao_2 {position: absolute; top: 160px; left: 562px;}
    #top_biao_3 {position: absolute; top: 160px; left: 697px;}
    #bot_biao_1 {position: absolute; top: 816px; left: 427px;}
    #bot_biao_2 {position: absolute; top: 816px; left: 562px;}
    #bot_biao_3 {position: absolute; top: 816px; left: 697px;}
    .status {width: 80px; color: #fff; font-size: 16px; float: left; border-right: 1px solid #5e99b7; height: 520px;}
    .status dt { height: 174px; vertical-align: middle; }
    .status dt div{ vertical-align: middle; display: table-cell; height: 174px; width: 80px; text-align: center;}
    .status dd { height: 173px; }
    .status dd div { vertical-align: middle; display: table-cell; height: 173px; width: 80px; text-align: center;border-top: 1px solid #5e99b7;}
    .des p {  width: 100%;  font-size: 48px;  padding-left: 50px;  margin-top: 50px;  }
    .des div {  width: 100%;  font-size: 14px;  text-align: right;  }
    .des div span {  padding-right: 20px;  }
    .alarm dt { padding: 50px 0 0 15px; }
    .alarm dd { padding: 10px 0 0 12px; font-size: 13px; }
    #sb_fan {position: absolute; top: 326px; left: 400px; z-index:100;}
    #sb_status {position: absolute; top: 414px; left: 409px;}
    #sb_yx {position: absolute; top: 334px; left: 404px;}
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
    .mod_setting {position: absolute; left: 817px;top: 718px; width: 285px; height: 180px; border-top: 1px solid #5e99b7; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/main_right_bg.jpg') repeat-x;}
    .mod_setting h3 {font-size: 24px;line-height: 36px;font-weight: normal;margin-top: 10px;color: #508c8c;margin-left: 15px;margin-bottom: 10px;}
    .mod_setting table {margin-left: 15px; }
    .mod_setting table td {width: 150px; font-size: 18px; line-height: 36px; }
    input.input-txt, input.input-txt:hover{ width: 40px !important; height: 30px; border-radius:0; font-size:18px; background-color:transparent; border: 1px solid #508c8c;}
    .btn{display:inline-block;margin-bottom:0;font-weight:400;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;padding:6px 12px;font-size:12px;line-height:1.42857143;border-radius:3px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;color:#fff;background-color:#18bc9c;margin-right:30px;float:left}
    .btn:hover {color:#fff; background-color: #15a589;}
</style>
<link rel="stylesheet" href="<?php echo ADMIN_RESOURCE_URL;?>/css/switch.css" type="text/css">
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷冻水泵</h3>
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

      <!-- 第二行文字BEGIN -->
      <div class="second_line">

          <div class="status">
              <dl>
                  <dt>
                    <div>
                        <p id="zc"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_zc_normal.png" ></p>
                        <p>正常</p>
                    </div>
                  </dt>
                  <dd>
                    <div>
                        <p id="jd"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_jd_normal.png" ></p>
                        <p>就地</p>
                    </div>
                  </dd>
                  <dd>
                    <div>
                        <p id="pl"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_pl_normal.png" ></p>
                        <p>旁路</p>
                    </div>
                  </dd>
              </dl>
          </div>

          <div style="padding-top: 130px;">
              <img alt="" src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_BG.png">
          </div>

      </div>
      <!-- 第二行文字END -->

      <div class="third_line">

          <div class="alarm">
              <dl>
                  <dt><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_alarm_normal.png" ></dt>
                  <dd>故障报警</dd>
              </dl>
          </div>

          <div class="des">
              <p id="CurFreq">
                  
              </p>
              <div><span>( Hz )实时频率</span></div>
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

            <div class="mod_setting">
                <h3>冷却泵模式设置</h3>
                <hr style="width: 95%; border: none; border-top: 1px solid #aba8a8;">
                
                <table>
                    <tr>
                        <td>模式</td>
                        <td>设定频率</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="testswitch">
                                <input class="testswitch-checkbox" id="onoffswitch_lqb" type="checkbox" >
                                <label class="testswitch-label" for="onoffswitch_lqb">
                                    <span class="testswitch-inner" data-on="自动" data-off="手动"></span>
                                    <span class="testswitch-switch"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <input type="text" value="48" name="FREQ_LQBEMER" id="FREQ_LQBEMER" data-curmod="" class="input-txt" onmouseout="this.style.backgroundColor='transparent';this.style.borderColor='#508c8c';">
                            Hz
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <a href="javascript:;" onclick="emer_set()" class="btn" style="float: none;">保存设置 </a>
                        </td>
                    </tr>
                </table>
            </div>

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


      <span id="sb_fan"><!-- 冷冻泵不受控 -->
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_Lf.png"  >
        <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_Lf.gif" > -->
      </span>
      <span id="sb_yx"><!-- 冷冻泵不受控 -->
        <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_YX.png"  > -->
      </span>
      <span id="sb_status"><!-- 冷冻泵不受控 -->
        <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_NC.png"  > -->
        <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_A.png" > -->
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
            data: {msg_name: "LQBState"},
            success: function (t) {//console.log(t)
                if( t.status == 1 ) {
                    var idx = <?php echo $output['idx']; ?>;
                    
                    var LQBInfo = t.data.MSGOBJ.LQBState.LQBInfo[idx][0] ;
                    //console.log(LQBInfo);

                    //当日开机时间
                    var starttime = LQBInfo.StartTime;
                    var newDate = new Date();
                    newDate.setTime(starttime * 1000);
                    starttime = newDate.format('h:m:s');
                    //当日关机时间
                    var endtime = LQBInfo.StopTime;
                    newDate.setTime(endtime * 1000);
                    endtime = newDate.format('h:m:s');

                    $("#CurPower").html(LQBInfo.CurPower > 0 ? LQBInfo.CurPower.toFixed(1) : 0);
                    $("#CurFreq").html(LQBInfo.CurFreq > 0 ? LQBInfo.CurFreq.toFixed(1) : 0);
                    $("#CurEnergy").html(LQBInfo.CurEnergy.toFixed(1));
                    $("#CurTime").html(LQBInfo.CurTime);
                    $("#TotalEnergy").html(LQBInfo.TotalEnergy.toFixed(0));
                    $("#TotalTime").html(LQBInfo.TotalTime);
                    $("#StartTime").html(dateFtt("hh:mm:ss",LQBInfo.StartTime));
                    $("#StopTime").html(dateFtt("hh:mm:ss",LQBInfo.StopTime));

                    //运行状态
                    if( LQBInfo.CurState & 1 ) {
                        $("#sb_fan").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_Lf.gif" >');
                        $("#sb_yx").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_YX.png" >');
                    }else {
                        $("#sb_fan").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_Lf.png" >');
                        $("#sb_yx").html('');
                    }
                    //非控状态
                    if( LQBInfo.CurMode != 1 ) {
                        $("#sb_status").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_NC.png" >');
                    }
                    //故障
                    if( LQBInfo.CurState & 2 ) {
                        $("#sb_status").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/SB_A.png" >');
                        $(".alarm dt").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_alarm_error.png">');
                    }
                    //模式显示
                    //正常
                    if( LQBInfo.CurMode == 1 ) {
                        $("#zc").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_zc_error.png" >');
                    }
                    //就地
                    if( LQBInfo.CurMode == 2 ) {
                        $("#jd").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_jd_error.png" >');
                    }
                    //旁路
                    if( LQBInfo.CurMode == 4 ) {
                        $("#pl").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_pl_error.png" >');
                    }

                    //基于准备好的dom，初始化echarts实例
                    option.series[0].max = 300;
                    var chart_c_one = echarts.init(document.getElementById('c_one'));//电流表A
                    var value_c_one = LQBInfo.CurEleA; //能力值取代码置于值于此处
                    $("#top_biao_1 dt").html(value_c_one);
                    option_c_one = option ;
                    option_c_one.series[0].data[0].value = Math.floor(value_c_one) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_one.setOption(option_c_one);


                    //基于准备好的dom，初始化echarts实例
                    var chart_c_two = echarts.init(document.getElementById('c_two'));//电流表B
                    var value_c_two = LQBInfo.CurEleB; //能力值取代码置于值于此处
                    $("#top_biao_2 dt").html(value_c_two);
                    option_c_two = option ;
                    option_c_two.series[0].data[0].value = Math.floor(value_c_two) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_two.setOption(option_c_two);


                    //基于准备好的dom，初始化echarts实例
                    var chart_c_three = echarts.init(document.getElementById('c_three'));//电流表C
                    var value_c_three = LQBInfo.CurEleC; //能力值取代码置于值于此处
                    $("#top_biao_3 dt").html(value_c_three);
                    option_c_three = option ;
                    option_c_three.series[0].data[0].value = Math.floor(value_c_three) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_c_three.setOption(option_c_three);


                    /** 电压表开始 **/

                    option.series[0].max = 600;
                    //基于准备好的dom，初始化echarts实例
                    var chart_t_one = echarts.init(document.getElementById('t_one'));//电压表A
                    var value_t_one = LQBInfo.CurVolA; //能力值取代码置于值于此处
                    $("#bot_biao_1 dt").html(value_t_one);
                    option_t_one = option ;
                    option_t_one.series[0].data[0].value = Math.floor(value_t_one) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_t_one.setOption(option_t_one);


                    //基于准备好的dom，初始化echarts实例
                    var chart_t_two = echarts.init(document.getElementById('t_two'));//电压表B
                    var value_t_two = LQBInfo.CurVolB; //能力值取代码置于值于此处
                    $("#bot_biao_2 dt").html(value_t_two);
                    option_t_two = option ;
                    option_t_two.series[0].data[0].value = Math.floor(value_t_two) ;
                    // 使用刚指定的配置项和数据显示图表。
                    chart_t_two.setOption(option_t_two);


                    //基于准备好的dom，初始化echarts实例
                    var chart_t_three = echarts.init(document.getElementById('t_three'));//电压表C
                    var value_t_three = LQBInfo.CurVolC; //能力值取代码置于值于此处
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

        $.ajax({
            url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getMsgObject",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {msg_name: "ACEGUIState"},
            success: function (t) {//console.log(t)
                if( t.status == 1 ) {
                    var SysInfo = t.data.MSGOBJ.ACEGUIState.SysInfo[0] ;
                    
                    $("#FREQ_LQBEMER").attr("data-curmod",SysInfo.ControlMode);
                    
                    var ldb_mod = (SysInfo.ControlMode & 2) ? 1 : 0;
                    //var ldb_freq = (ldb_mod == 1) ? SysInfo.LDBEFreq : SysInfo.LDBAFreq1;
                    //$("#ldb_freq").html(ldb_freq);
                    if( ldb_mod == 0 ) {
                        $("#onoffswitch_lqb").attr('checked','true');
                    } 
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
    var commond = "SWITCH_LQB" + idx;

    var ctl = (flag == 1) ? "运行" : "停止";

    layer.alert('确认'+ ctl +'冷却水泵'+idx+'吗？', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "冷却水泵启停",
            yes:function(index){
                $.ajax({
                    url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                    type: "get",
                    timeout : 500,
                    dataType: "json",
                    data: {msg_name: commond, msg_value : flag},
                    success: function (t) {
                        if( t.status == '1' ) {
                        } else {
                        }
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

function emer_set() {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    layer.alert("确认保存控制模式设置吗？", 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "控制模式设置",
            yes:function(index){
                //var emer = ['FREQ_LDBEMER','FREQ_LQBEMER','FREQ_RSBEMER'];
                //var eswtich = ['onoffswitch_ldb','onoffswitch_lqb','onoffswitch_rsb'];
                if( $("#FREQ_LQBEMER").val() != '' && !$("#onoffswitch_lqb").prop('checked') ) {
                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: { msg_name: 'FREQ_LQBEMER', msg_value : $("#FREQ_LQBEMER").val() },
                        success: function (t) {
                            if( t.status == '1' ) {
                                //alert("操作成功");
                            } else {
                                //alert("操作失败");
                            }
                        }
                    });
                }
                //控制模式
                var c_model = $("#FREQ_LQBEMER").attr("data-curmod");
                //console.log(c_model);
                c_model = c_model & 5 ;
                //console.log(c_model);
                if( $("#onoffswitch_lqb").prop('checked') ) {
                    c_model = c_model | 0;
                } else {
                    c_model = c_model | 2;
                }
                //console.log(c_model);
                $.ajax({
                    url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                    type: "get",
                    timeout : 500,
                    dataType: "json",
                    data: {msg_name: 'SYS_CTRLMODE', msg_value : c_model},
                    success: function (t) {
                        if( t.status == '1' ) {
                        } else {
                        }
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