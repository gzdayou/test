<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body {
        /*background: url("<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg") repeat-y;*/
    }
    .content{overflow: hidden; width: 100%; height: 838px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .page {padding: 62px 0 0 10px;}
    #param_box { border: 1px solid #404040; color: #404040; width: 1090px; height: 233px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/main_param_bg.jpg') repeat-x;}
    #box_left, #box_right { position: absolute; margin-top: 10px; }
    #box_left { left: 30px; width: 780px; }
    #box_right { left: 840px; }
    #box_left h3, #box_right h3 {font-size: 24px; line-height: 36px; font-weight: normal; }
    #box_left .params { margin-top: 40px; width: 800px; }
    #box_left .params .row{ width: 33%; font-size: 16px; float: left; }
    #box_left .params .row span {display:inline-block; text-align: center; height: 30px; width: 80px; border: 1px solid #508c8c; color: #508c8c;}
    #box_left .params .row p {line-height: 37px; }
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_fan_1 {position: absolute; top: 282px; left: 275px;z-index: 100;}
    .content #left_fan_2 {position: absolute; top: 344px; left: 255px;z-index: 100;}
    .content #left_fan_3 {position: absolute; top: 414px; left: 233px;z-index: 100;}
    .content #right_fan_1 {position: absolute; top: 284px; left: 816px;z-index: 100;}
    .content #right_fan_2 {position: absolute; top: 344px; left: 835px;z-index: 100;}
    .content #right_fan_3 {position: absolute; top: 417px; left: 857px;z-index: 100;}
    .content #top_fan_1 {position: absolute; top: 134px; left: 738px;z-index: 100;}
    .content #top_fan_2 {position: absolute; top: 134px; left: 792px;z-index: 100;}
    .content #top_fan_3 {position: absolute; top: 134px; left: 846px;z-index: 100;}
    .content #center_wheel_1 {position: absolute; top: 266px; left: 536px;}
    .content #center_wheel_2 {position: absolute; top: 361px; left: 534px;}
    .content #center_wheel_3 {position: absolute; top: 478px; left: 530px;}
    .content #host_status_1 { position: absolute; top: 268px; left: 554px; }
    .content #host_status_2 {position: absolute; top: 364px; left: 554px;}
    .content #host_status_3 {position: absolute; top: 480px; left: 552px;}
    .content #ldb_status_1 {position: absolute; top: 301px; left: 276px;}
    .content #ldb_status_2 {position: absolute; top: 364px; left: 257px;}
    .content #ldb_status_3 {position: absolute; top: 435px; left: 234px;}
    .content #lqb_status_1 {position: absolute; top: 301px; left: 813px;}
    .content #lqb_status_2 {position: absolute; top: 364px; left: 832px;}
    .content #lqb_status_3 {position: absolute; top: 436px; left: 852px;}
    .content #host_light_1 {position: absolute; top: 270px; left: 501px;}
    .content #host_light_2 {position: absolute; top: 366px; left: 496px;}
    .content #host_light_3 {position: absolute; top: 482px; left: 488px;}
    .content #lqt_status_1 {position: absolute; top: 134px; left: 735px;z-index: 99;}
    .content #lqt_status_2 {position: absolute; top: 134px; left: 789px;z-index: 99;}
    .content #lqt_status_3 {position: absolute; top: 134px; left: 844px;z-index: 99;}
    .content #ldb_yx_1 {position: absolute; top: 287px; left: 276px;}
    .content #ldb_yx_2 {position: absolute; top: 350px; left: 257px;}
    .content #ldb_yx_3 {position: absolute; top: 419px; left: 234px;}
    .content #lqb_yx_1 {position: absolute; top: 288px; left: 816px;}
    .content #lqb_yx_2 {position: absolute; top: 349px; left: 834px;}
    .content #lqb_yx_3 {position: absolute; top: 421px; left: 854px;}
    .notice { position: absolute; top: 560px; left: 395px; }
    .p_right div {  position: absolute;  left: 875px;  background: url(<?php echo ADMIN_RESOURCE_URL;?>/image/data_bg.png) no-repeat;  width: 190px;  height: 37px;  font-size: 14px;  line-height: 37px;  color: #fff;  padding: 0 0 0 10px;  }
    .p_right span { margin-left: 10px; position: absolute;background: url(<?php echo ADMIN_RESOURCE_URL;?>/image/data_bg.png) no-repeat;width: 100px;height: 37px;font-size: 14px; font-weight:bold;line-height: 37px;color: #fff;padding: 0 0 0 10px; }
    .p_right .p1 {  top: 220px;  }
    .p_right .p2 {  top: 270px;  }
    .p_right .p3 {  top: 320px;  }
    .p_right .p4 {  top: 370px;  }
    .p_right .p5 {  top: 420px;  }
    .p_right .p6 {  top: 470px;  }
    .p_right .p7 {  top: 520px;  }
    dl { display: inline-block; width: 250px; margin-bottom: 10px; }
    dl dt, dl dd { float:left; font-size: 16px; }
    dl dt {text-align: left; width: 80px;}
    dl dd {text-align: center; width: 80px;}
    #b_right{position: absolute; top: 666px; left: 800px; border-left:1px solid #404040;border-right:1px solid #404040; height: 233px;background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/main_right_bg.jpg') repeat-x;}
    #b_right h3 {font-size: 24px; line-height: 36px; font-weight: normal; margin-top: 10px; color: #508c8c; margin-left: 15px; margin-bottom:22px;}
    #b_right dl {margin-left: 15px; line-height: 40px;}
    .c_l {color: #508c8c; font-size: 22px;}
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷热源站</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>

  <div class="content">
      <div>
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/ACE-Main.png" width="1100" style="margin: 60px 0;" >

          <span id="left_fan_1">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.png" width="20" >
          </span>

          <span id="left_fan_2">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.png" width="20" >
          </span>

          <span id="left_fan_3">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.png" width="20" >
          </span>

          <span id="right_fan_1">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.png" width="20" >
          </span>

          <span id="right_fan_2">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.png" width="20" >
          </span>

          <span id="right_fan_3">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.gif" width="20" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.png" width="20" >
          </span>

          <span id="top_fan_1">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif" width="30" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" width="30" >
          </span>

          <span id="top_fan_2">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif" width="30" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" width="30" >
          </span>

          <span id="top_fan_3">
          <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif" width="30" > -->
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" width="30" >
          </span>


        
          <span id="center_wheel_1">
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_Lf.gif" height="30" > -->
          </span>
           <span id="center_wheel_2">
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_Lf.gif"  height="30" > -->
          </span>
          <span id="center_wheel_3">
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_Lf.gif" height="34" > -->
          </span>


          <!-- 冷冻泵运行 -->
          <span id="ldb_yx_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" height="20" > -->
          </span>
          <span id="ldb_yx_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" height="20" > -->
          </span>
          <span id="ldb_yx_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" height="22" > -->
          </span>
          <!-- 冷冻泵运行 -->

          <!-- 冷却泵运行 -->
          <span id="lqb_yx_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_YX.png" height="20" > -->
          </span>
          <span id="lqb_yx_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_YX.png" height="20" > -->
          </span>
          <span id="lqb_yx_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_YX.png" height="22" > -->
          </span>
          <!-- 冷却泵运行 -->

          <!-- 错误提醒开始 -->
          <span id="ldb_status_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_NC.png" height="22" > -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_A.png" height="22" > -->
          </span>
          <span id="ldb_status_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_NC.png" height="22" >
              <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_A.png" height="22" > -->
          </span>
          <span id="ldb_status_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_NC.png" height="24" >
              <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_A.png" height="24" > -->
          </span>

          <span id="lqb_status_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_NC.png" height="22" > -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_A.png" height="22" > -->
          </span>
          <span id="lqb_status_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_NC.png" height="23" > -->
               <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_A.png" height="22" > -->
          </span>
          <span id="lqb_status_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_NC.png" height="24" > -->
               <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_A.png" height="24" > -->
          </span>

          <span id="host_status_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_NC.png" height="22" > -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_A.png" height="22" > -->
          </span>
          <span id="host_status_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_NC.png" height="24" > -->
               <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_A.png" height="24" > -->
          </span>
          <span id="host_status_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_NC.png" height="27" > -->
               <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_A.png" height="27" > -->
          </span>
          <!-- 错误提醒结束 -->


          <!-- 主机状态灯开始 -->
          <span id="host_light_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_YX.png" width="34" > -->
          </span>
          <span id="host_light_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host2_YX.png" width="36" > -->
          </span>
          <span id="host_light_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host3_YX.png" width="41" > -->
          </span>
          <!-- 主机状态灯结束 -->


            <!-- 冷却塔状态开始 -->
            <span id="lqt_status_1"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_NC.png" width="36" > -->
            </span>
            <span id="lqt_status_2"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" width="36" > -->
            </span>
            <span id="lqt_status_3"><!-- 冷冻泵不受控 -->
              <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" width="36" > -->
            </span>
            <!-- 冷却塔状态开始 -->
          
          <span style="position: absolute; top: 620px; left: 475px;">
          	<label style="width:50px; height: 50px; background-color: #ffaa4a;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><font style="font-size: 16px; color: #fff;">&nbsp;&nbsp;不受控</font>
          	&nbsp;&nbsp;
          	<label style="width:50px; height: 50px; background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><font style="font-size: 16px; color: #fff;">&nbsp;&nbsp;故障</font>
          </span>

      </div>
      
      

      <div id="param_box" >

          <div id="box_left">
              <h3>系统参数</h3>
              <div class="params">

                    <div class="row">
                        <p id="TemACE1"><em>冷冻供水温度&nbsp;&nbsp;</em><span style=""></span>&nbsp;&nbsp;℃</p>
                        <p id="TemACE2"><em>冷冻回水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="LDSFlow"><em>冷冻总管流量&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;m3/h</p>
                    </div>

                    <div class="row">
                        <p id="TemACE3"><em>冷却供水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="TemACE4"><em>冷却回水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="LQSFlow"><em>冷却总管流量&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;m3/h</p>
                    </div>

                    <div class="row">
                  
                        <p id="LDSOutPress"><em>冷冻供水压力&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                        <p id="LDSInPress"><em>冷冻回水压力&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                        <p id="LDSPressDiff"><em>供回水压差值&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                    </div>

              </div>
          </div>

          <div id="b_right">
                <h3>&nbsp;</h3>
                <dl>
                    <dt>冷冻泵频率</dt>
                    <dd id="ldb_mode" class="c_l">&nbsp;</dd>
                    <dd><span id="ldb_freq" class="c_l">&nbsp;</span>&nbsp;&nbsp;Hz</dd>
                </dl>
                <dl>
                    <dt>冷却泵频率</dt>
                    <dd id="lqb_mode" class="c_l">&nbsp;</dd>
                    <dd><span id="lqb_freq" class="c_l">&nbsp;</span>&nbsp;&nbsp;Hz</dd>
                </dl>
                <dl>
                    <dt>热水泵频率</dt>
                    <dd id="rsb_mode" class="c_l">&nbsp;</dd>
                    <dd><span id="rsb_freq" class="c_l">&nbsp;</span>&nbsp;&nbsp;Hz</dd>
                </dl>
          </div>

          <div style="position: absolute; top: 730px; left: 15px; width: 780px; border-top: 1px solid #aba8a8;">
          &nbsp;
          </div>
          <div style="position: absolute; top: 730px; left: 804px; width: 282px; border-top: 1px solid #aba8a8;">
          &nbsp;
          </div>

      </div>
  </div>

</div>

<script type="text/javascript">
$(function(){

    ajaxFunc();

    setInterval(ajaxFunc, <?php echo C("ajax_time"); ?>);

    function ajaxFunc() {
        $.ajax({
            url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getMsgObject",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {msg_name: "ACEGUIState"},
            success: function (t) {//console.log(t)
                if( t.status == 1 ) {
                    var ACEGUIState = t.data.MSGOBJ.ACEGUIState ;
                    //console.log(ACEGUIState.SysInfo[0]);
                    var sysInfo = ACEGUIState.SysInfo[0];

                    $("#LDSPressDiff span").html(sysInfo.LDSPressDiff.toFixed(3));
                    $("#LDSFlow span").html(sysInfo.LDSFlow.toFixed(1));
                    $("#LQSFlow span").html(sysInfo.LQSFlow.toFixed(1));
                    $("#TemACE1 span").html(sysInfo.TemACE1.toFixed(1));
                    $("#TemACE2 span").html(sysInfo.TemACE2.toFixed(1));
                    $("#TemACE3 span").html(sysInfo.TemACE3.toFixed(1));
                    $("#TemACE4 span").html(sysInfo.TemACE4.toFixed(1));
                    $("#LDSOutPress span").html(sysInfo.LDSOutPress ? sysInfo.LDSOutPress.toFixed(2) : 0.0);
                    $("#LDSInPress span").html(sysInfo.LDSInPress ? sysInfo.LDSInPress.toFixed(2) : 0.0);

                    //冷冻泵状态
                    var ldbInfo = ACEGUIState.LDBInfo;
                    var bi = [20,20,22];
                    for(var i = 0;i < ldbInfo.length; i++) {
                        var hei = bi[i];
                        info = ldbInfo[i][0];
                        idx = parseInt(i) + parseInt(1);
                        //风扇运行
                        if( info.CurState & 1 ) {
                            $("#left_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.gif" width="20" >');
                            $("#ldb_yx_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" height="'+hei+'" >');
                        } else {
							$("#left_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_Lf.png" width="20" >');
							$("#ldb_yx_" + idx).html('');
						}
                        //非控状态
                        if( info.CurMode != 1 ) {
                            var height = (idx == 3) ? 24 : 22;
                            $("#ldb_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_NC.png" height="'+height+'" >');
                        } else {
							$("#ldb_status_" + idx).html('');
						}
                        //泵故障状态
                        if( info.CurState & 2 ) {
                            var height = (idx == 3) ? 24 : 22;
                            $("#ldb_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LDB1_A.png" height="'+height+'" >');
                        }
                    }

                    //冷却泵状态
                    var lqbInfo = ACEGUIState.LQBInfo;
                    var bi = [20,20,22];
                    for(var i = 0;i < lqbInfo.length; i++) {
                        var hei = bi[i];
                        info = lqbInfo[i][0];
                        idx = parseInt(i) + parseInt(1);
                        //风扇运行
                        if( info.CurState & 1 ) {
                            $("#right_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.gif" width="20" >');
                            $("#lqb_yx_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_YX.png" height="'+hei+'" >');
                        } else {
							$("#right_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_Lf.png" width="20" >');
							$("#lqb_yx_" + idx).html('');
						}
						$("#lqb_status_" + idx).html('');
                        //非控状态
                        if( info.CurMode != 1 ) {
                            var height = (idx == 3) ? 24 : 22;
                            $("#lqb_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_NC.png" height="'+height+'" >');
                        } 
                        //泵故障状态
                        if( info.CurState & 2 ) {
                            var height = (idx == 3) ? 24 : 22;
                            $("#lqb_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQB1_A.png" height="'+height+'" >');
                        }
                    }

                    //主机状态
                    var hostInfo = ACEGUIState.HostInfo;
                    for(var i = 0;i < hostInfo.length; i++) {
                        info = hostInfo[i][0];
                        idx = parseInt(i) + parseInt(1);
                        //齿轮运行，灯亮
                        if( info.CurState & 1 ) {
                            var height = [34,36,41];
                            $("#host_light_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_YX.png" width="'+height[i]+'" >');
                            var height = [30,30,34];
                            $("#center_wheel_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_Lf.gif" height="'+height[i]+'" >');
                        } else {
							$("#host_light_" + idx).html('');
							$("#center_wheel_" + idx).html('');
						}
						$("#host_status_" + idx).html('');
                        //主机故障状态
                        if( info.CurState & 2 ) {
                            var height = [22,24,27];
                            $("#host_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/Host1_A.png" height="'+height[i]+'" >');
                        }
                    }

                    //冷却塔状态
                    var lqtInfo = ACEGUIState.LQTInfo[0][0];
                    var bi = [1,2,4];
                    //运行状态
                    for ( var i=0; i < bi.length; i++ ) {
                        var wei = bi[i];
                        idx = parseInt(i) + parseInt(1);
                        //开反馈状态
                        if( lqtInfo.FeedOn & wei ) {
                            $("#lqt_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" width="36" >');
                            $("#top_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif" width="30" >');
                        } else {
							$("#lqt_status_" + idx).html('');
                            $("#top_fan_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" width="30" >');
						}
                        //故障反馈状态
                        if( lqtInfo.FeedErr & wei ) {
                            $("#lqt_status_" + idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" width="36" >');
                        }
                    }

                    //控制模式
                    $("#b_right h3").html( (sysInfo.SeasonMode == 1) ? "夏季模式" : "冬季模式" );
                    $("#ldb_mode").html((sysInfo.ControlMode & 1) ? "手动" : "自动");
                    $("#lqb_mode").html((sysInfo.ControlMode & 2) ? "手动" : "自动");
                    $("#rsb_mode").html((sysInfo.ControlMode & 4) ? "手动" : "自动");
                    $("#ldb_freq").html((sysInfo.ControlMode & 1) ? sysInfo.LDBEFreq.toFixed(1) : sysInfo.LDBAFreq1.toFixed(1));
                    $("#lqb_freq").html((sysInfo.ControlMode & 2) ? sysInfo.LQBEFreq.toFixed(1) : sysInfo.LQBAFreq1.toFixed(1));
                    $("#rsb_freq").html((sysInfo.ControlMode & 4) ? sysInfo.RSBEFreq.toFixed(1) : sysInfo.RSBAFreq1.toFixed(1));

                } else {
                    //alert("ZMQ数据获取出错");
                }
            }
        });
    }
});
</script>
