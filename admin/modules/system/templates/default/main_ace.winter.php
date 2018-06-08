<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body {
        /*background: url("<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg") repeat-y;*/
    }
    .content{width: 100%; height: 889px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .page {padding: 62px 0 0 1%;}
    #param_box { border: 1px solid #404040; color: #404040; width: 1090px; height: 233px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/main_param_bg.jpg') repeat-x;}
    #box_left, #box_right { position: absolute; margin-top: 10px; }
    #box_left { left: 30px; width: 800px; }
    #box_right { left: 840px; }
    #box_left h3, #box_right h3 {font-size: 24px; line-height: 36px; font-weight: normal; }
    #box_left .params { margin-top: 20px; width: 800px; }
    #box_left .params .row{ width: 33%; font-size: 16px; float: left; }
    #box_left .params .row span {display:inline-block; text-align: center; height: 30px; width: 80px; border: 1px solid #508c8c; color: #508c8c;}
    #box_left .params .row p {     line-height: 37px; }
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_fan_1 {position: absolute; top: 282px; left: 275px;}
    .content #bh_1 {position: absolute; top: 326px; left: 602px;}
    .content #bh_2 {position: absolute; top: 486px; left: 610px;}
    .content #yx_1 {position: absolute; top: 323px; left: 287px;}
    .content #yx_2 {position: absolute; top: 376px; left: 275px;}
    .content #yx_3 {position: absolute; top: 432px; left: 258px;}
    .content #status_1 {position: absolute; top: 343px; left: 288px;}
    .content #status_2 {position: absolute; top: 395px; left: 277px;}
    .content #status_3 {position: absolute; top: 452px; left: 260px;}
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
    #b_right h3 {font-size: 24px; line-height: 36px; font-weight: normal; margin-top: 10px; color: #508c8c; margin-left: 15px; margin-bottom:10px;}
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
          <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/ACE-Winter.png" width="1100" >

          <span id="bh_1">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/BH1_Lf.gif" width="120" > -->
          </span>
          <span id="bh_2">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/BH1_Lf.gif" width="136" > -->
          </span>

          <span id="yx_1">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" width="26" > -->
          </span>
          <span id="yx_2">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" width="26" > -->
          </span>
          <span id="yx_3">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" width="26" > -->
          </span>

          <span id="status_1">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-A.png" width="26" > -->
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-NC.png" width="26" > -->
          </span>
          <span id="status_2">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB2-A.png" width="26" > -->
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB2-NC.png" width="26" > -->
          </span>
          <span id="status_3">
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB3-A.png" width="26" > -->
                <!-- <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB3-NC.png" width="26" > -->
          </span>

          <span style="position: absolute; top: 600px; left: 475px;">
          	<label style="width:50px; height: 50px; background-color: #ffaa4a;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><font style="font-size: 16px; color: #fff;">&nbsp;&nbsp;不受控</font>
          	&nbsp;&nbsp;
          	<label style="width:50px; height: 50px; background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><font style="font-size: 16px; color: #fff;">&nbsp;&nbsp;故障</font>
          </span>

      </div>
      
      

      <div id="param_box" >

          <div id="box_left">
              <h3>系统参数</h3>
              <p style="border-top:1px solid #aba8a8; width: 750px; height:1px; margin-top: 10px;">&nbsp;</p>
              <div class="params">

                    <!-- <div class="row">
                        <p id="TemACE1"><em>冷冻水供水温度&nbsp;&nbsp;</em><span style=""></span>&nbsp;&nbsp;℃</p>
                        <p id="TemACE2"><em>冷冻水回水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="TemACE3"><em>冷却水供水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="TemACE4"><em>冷却水回水温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                    </div>

                    <div class="row">
                        <p id="LDSFlow"><em>冷冻水总管流量&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;m3/h</p>
                        <p id="LQSFlow"><em>冷却水总管流量&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;m3/h</p>
                        <p id="LDSOutPress"><em>热水水供水压力&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                        <p id="LDSInPress"><em>热水水回水压力&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                    </div>

                    <div class="row">
                  
                        <p id="OTem"><em style="display: inline-block; width: 89px;text-align: right;">室外温度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;℃</p>
                        <p id="OHum"><em style="display: inline-block; width: 89px;text-align: right;">室外湿度&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;%</p>
                        <p id="WetBulb"><em style="display: inline-block; width: 89px;text-align: right;">湿球温度&nbsp;&nbsp;</em><span>789</span>&nbsp;&nbsp;℃</p>
                        <p id="LDSPressDiff"><em>供回水压差&nbsp;&nbsp;</em><span></span>&nbsp;&nbsp;bar</p>
                    </div> -->
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
                <hr style="width: 95%; border: none; border-top: 1px solid #aba8a8;">
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

                    //状态显示
                    rsbInfo = ACEGUIState.RSBInfo;
                    for(i=0;i<rsbInfo.length;i++){
                        rsb = rsbInfo[i][0] ;
                        idx = Number(i) + Number(1);
                        //运行状态
                        if ( rsb.CurState && 1  ) {
                            $("#yx_"+idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB1-YX.png" width="26" >');
                            $("#bh_"+idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/BH1_Lf.gif" width="120" >');
                        }
                        //故障报警
                        if ( rsb.CurState && 2  ) {
                            $("#status_"+idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB'+idx+'-A.png" width="26" >');
                        }
                        //非控状态
                        if ( rsb.CurMode != 1  ) {
                            $("#status_"+idx).html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/RSB'+idx+'-NC.png" width="26" >');
                        }
                    }

                    //系统参数
                    $("#LDSPressDiff span").html(sysInfo.LDSPressDiff);
                    $("#LDSFlow span").html(sysInfo.LDSFlow);
                    $("#LQSFlow span").html(sysInfo.LQSFlow);
                    $("#TemACE1 span").html(sysInfo.TemACE1);
                    $("#TemACE2 span").html(sysInfo.TemACE2);
                    $("#TemACE3 span").html(sysInfo.TemACE3);
                    $("#TemACE4 span").html(sysInfo.TemACE4);
                    $("#OTem span").html(sysInfo.OTem);
                    $("#OHum span").html(sysInfo.OHum);
                    $("#WetBulb span").html(sysInfo.WetBulb);
                    $("#LDSOutPress span").html(sysInfo.LDSOutPress ? sysInfo.LDSOutPress : 0);
                    $("#LDSInPress span").html(sysInfo.LDSInPress ? sysInfo.LDSInPress : 0);
                    //控制模式
                    $("#b_right h3").html( (sysInfo.SeasonMode == 1) ? "夏季模式" : "冬季模式" );
                    $("#ldb_mode").html((sysInfo.ControlMode & 1) ? "手动" : "自动");
                    $("#lqb_mode").html((sysInfo.ControlMode & 2) ? "手动" : "自动");
                    $("#rsb_mode").html((sysInfo.ControlMode & 4) ? "手动" : "自动");
                    $("#ldb_freq").html((sysInfo.ControlMode & 1) ? sysInfo.LDBEFreq : sysInfo.LDBAFreq1);
                    $("#lqb_freq").html((sysInfo.ControlMode & 2) ? sysInfo.LQBEFreq : sysInfo.LQBAFreq1);
                    $("#rsb_freq").html((sysInfo.ControlMode & 4) ? sysInfo.RSBEFreq : sysInfo.RSBAFreq1);

                } else {
                    alert("ZMQ数据获取出错");
                }
            }
        });
    }
});
</script>
