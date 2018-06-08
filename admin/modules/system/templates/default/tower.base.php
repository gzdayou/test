<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body { color: #fff; }
    .content{ width: 100%; height: 838px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; }
    .page { padding: 62px 0 0 1%; }
    .fixed-bar {padding-bottom: 8px;}
    .first_line { width: 1272px; color: #fff;border-bottom: 1px #5e99b7 solid; }
    .controll { width: 80px; border-right: 1px #5e99b7 solid;  float: left;  }
    .controll dl dt { border-bottom: 1px #5e99b7 solid; }
    .controll dl dt span { width: 100%; text-align: center; margin: 0 auto ; }
    .controll dl dt span img { display: block; margin: 10px 0 10px 27px; }
    .controll dl em { width : 100%; text-align: center; margin: 0 auto; display: block; font-size: 16px; }
    .controll dl dd span img { display: block; margin: 10px 0 10px 27px; }
    .controll a {color: #fff;}
    .second_line { width: 806px; text-align: center; height: 520px;  }
    .second_line p { color: #fff;}
    .third_line { height: 180px; }
    .alarm { width: 80px; color: #fff; font-size: 16px; float: left; border-right: 1px solid #5e99b7;border-top: 1px solid #5e99b7; height: 180px;}
    .bg {width: 180px; border-radius: 5px; margin-left: 20px; }
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
    .status {width: 80px; color: #fff; font-size: 16px; float: left; border-right: 1px solid #5e99b7; height: 520px;}
    .status dt { height: 174px; vertical-align: middle; }
    .status dt div{ vertical-align: middle; display: table-cell; height: 174px; width: 80px; text-align: center;}
    .status dd { height: 173px; }
    .status dd div { vertical-align: middle; display: table-cell; height: 173px; width: 80px; text-align: center;border-top: 1px solid #5e99b7;}
    .alarm dt { padding: 50px 0 0 15px; }
    .alarm dd { padding: 10px 0 0 12px; font-size: 13px; }
    .lqt_list { padding-top: 100px; }
    .lqt_list div img {  }
    .lqt_list dt { line-height: 46px; font-size: 14px; }
    .lqt_list .selected { color: yellow; }
    .lqt_list .selected dd img { transition:all 0.3s; -moz-box-shadow:5px 5px 10px 10px #333333; -webkit-box-shadow:5px 5px 10px 10px #333333; box-shadow:5px 5px 10px 10px #333333; }
    #fan_1 {position: absolute; top: 342px; left: 193px;z-index:100;}
    #fan_2 {position: absolute; top: 342px; left: 434px;z-index:100;}
    #fan_3 {position: absolute; top: 342px; left: 676px;z-index:100;}
    #error_1 {position: absolute; top: 344px; left: 189px;z-index:99;}
    #error_2 {position: absolute; top: 344px; left: 431px;z-index:99;}
    #error_3 {position: absolute; top: 344px; left: 673px;z-index:99;}
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
    .lqt_list table td {width: 300px;}
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>冷却塔</h3>
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
      
      
      <div class="cur_selected" style="position: absolute; top: 100px; left: 360px; font-size: 36px;">
        冷却塔<span>1</span>
      </div>
      
      
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
        
        <div class="lqt_list">
            <!-- <div style="float: left; margin-left: 100px;" class="selected" id="tower_1" onclick="choose(this, 1)" >
                <dl>
                <dt>1</dt>
                <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png" style=""></dd>
                </dl>
            </div>
            <div style="float: right; margin-right: 100px;" id="tower_2" onclick="choose(this, 2)" >
                <dl>
                <dt>2</dt>
                <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png"></dd>
                </dl>
            </div>
            <div style="clear: right;  "></div>
            <div style="margin-top: 50px;" id="tower_3" onclick="choose(this, 3)" >
                <dl>
                <dt>3</dt>
                <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png"></dd>
                </dl>
            </div> -->
            <table>
                <tr>
                    <td onclick="choose(this, 1)"  class="selected">
                        <dl>
                            <dt>1</dt>
                            <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png" style=""></dd>
                        </dl>
                    </td>
                    <td onclick="choose(this, 2)">
                        <dl>
                            <dt>2</dt>
                            <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png" style=""></dd>
                        </dl>
                    </td>
                    <td onclick="choose(this, 3)">
                        <dl>
                            <dt>3</dt>
                            <dd><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/LQT_BG.png" style=""></dd>
                        </dl>
                    </td>
                </tr>
            </table>
          
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

          <div style="clear: both;"></div>
      </div>

      <!-- 冷却塔风扇开始 -->
      <span id="fan_1" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" >
      </span>

      <span id="fan_2" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" >
      </span>

      <span id="fan_3" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png" >
      </span>

      <span id="error_1" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" >
      </span>
      <span id="error_2" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" >
      </span>
      <span id="error_3" >
        <img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" >
      </span>
      <!-- 冷却塔风扇结束 -->


      <div class="p_right">
          <table class="gridtable" style="position: absolute; left: 817px;top: 197px;">
                <tr>
                    <td class="col_one">当日小计电量</td>
                    <td class="col_two" id="CurEnergy">&nbsp;</td>
                    <td class="col_three">KW/h</td>
                </tr>
                <tr>
                    <td class="col_one">总计运行电量</td>
                    <td class="col_two" id="TotalEnergy">&nbsp;</td>
                    <td class="col_three">KW/h</td>
                </tr>
            </table>
      </div>

      <div style="position: absolute; top: 20px; left: 816px;width:1px; height: 880px; border-right: 1px #5e99b7 solid;">&nbsp;</div>

      
  </div>

</div>

<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/echarts.min.js"></script>
<script>

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
            data: {msg_name: "LQTState"},
            success: function (t) {//console.log(t)
                if( t.status == 1 ) {

                    var TowerInfo = t.data.MSGOBJ.LQTState.LQTInfo[0][0] ;
                    //console.log(TowerInfo);
                    //风扇转动显示
                    if( TowerInfo['FeedOn'] & 1 ) {
                        $("#fan_1").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif">');
                        $("#error_1").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" >');
                    } else {
                        $("#fan_1").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png">');
                        $("#error_1").html('');
                    }
                    if( TowerInfo['FeedOn'] & 2 ) {
                        $("#fan_2").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif">');
                        $("#error_2").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" >');
                    }else{
                        $("#fan_2").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png">');
                        $("#error_2").html('');
                    }
                    if( TowerInfo['FeedOn'] & 4 ) {
                        $("#fan_3").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.gif">');
                        $("#error_3").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_YX.png" >');
                    } else {
                        $("#fan_3").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_Lf.png">');
                        $("#error_3").html('');
                    }
                    //故障
                    if( TowerInfo['FeedErr'] & 1 ) $("#error_1").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" >');
                    if( TowerInfo['FeedErr'] & 2 ) $("#error_2").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" >');
                    if( TowerInfo['FeedErr'] & 4 ) $("#error_3").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/source_station/LQT1_A.png" >');
                    
                    //模式显示
                    //正常
                    if( TowerInfo.CurMode == 1 ) {
                        $("#zc").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_zc_error.png" >');
                    }
                    //就地
                    if( TowerInfo.CurMode == 2 ) {
                        $("#jd").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_jd_error.png" >');
                    }
                    //旁路
                    if( TowerInfo.CurMode == 4 ) {
                        $("#pl").html('<img src="<?php echo ADMIN_RESOURCE_URL;?>/image/btn_status_pl_error.png" >');
                    }

                    $("#CurEnergy").html(TowerInfo.CurEnergy.toFixed(2));
                    $("#TotalEnergy").html(TowerInfo.TotalEnergy.toFixed(2));

                } else {
                    //alert("ZMQ数据获取出错");
                }
            }
        });
    }
});

//冷却塔点击事件
function choose(obj, idx) {
  $(obj).siblings().removeClass("selected");
  $(obj).addClass("selected");
  $(".cur_selected span").html(idx);
}


function turn( flag ) {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    var idx = $(".cur_selected span").html();
    var commond = "SWITCH_LQT1-" + idx;

    var ctl = (flag == 1) ? "运行" : "停止";

    layer.alert('确认'+ ctl +'冷却塔'+idx+'吗？', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "冷却塔启停",
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

</script>