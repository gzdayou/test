<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    .fixed-bar{padding-bottom: 8px;} 
    .content{width: 1121px; height: 700px;} 
    .widget-shadow{float: left;margin-right: 30px;margin-bottom:30px;width: 530px;background-color: #fff;box-shadow: 0 -1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);-webkit-box-shadow: 0 -1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);-moz-box-shadow: 0 -1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);} .form-title{padding: 1em 2em;background-color: #EAEAEA;border-bottom: 1px solid #D6D5D5;}
    h4{font-size: 1.3em; color: #6F6F6F;}
    .form-body{padding: 1.5em 2em;}
    dl{display: inline-block; width: 500px; font-size: 16px; height: 42px; line-height: 42px;}
    dl dt, dl dd{float: left;width: 100px;}
    .pl_setting dl {height: 36px;}
    .pl_setting dt { width: 150px; }
    .input-txt {width: 50px !important;}
    .radio{display: inline-block; position: relative; line-height: 18px; margin-right: 10px; cursor: pointer;}
    .radio input{display: none;}
    .radio .radio-bg{display: inline-block; height: 18px; width: 18px; margin-right: 5px; padding: 0; border-radius: 100%; vertical-align: top; box-shadow: 0 1px 15px rgba(0, 0, 0, 0.1) inset, 0 1px 4px rgba(0, 0, 0, 0.1) inset, 1px -1px 2px rgba(0, 0, 0, 0.1); cursor: pointer; transition: all 0.2s ease;}
    .radio .radio-on{display: none;}
    .radio input:checked + span.radio-on{width: 10px; height: 10px; position: absolute; border-radius: 100%; background: #45bcb8; top: 4px; left: 4px; transform: scale(0, 0); transition: all 0.2s ease; transform: scale(1, 1); display: inline-block;}
    .season_mod {position: absolute; top: 600px; left: 20px; width:240px; padding-top: 60px; }
    .p1 { font-size: 16px; }
    .p1 span { color: red; }
    .btn{display:inline-block;margin-bottom:0;font-weight:400;text-align:center;vertical-align:middle;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;padding:6px 12px;font-size:12px;line-height:1.42857143;border-radius:3px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;color:#fff;background-color:#18bc9c;margin-right:30px;float:left}
    .btn:hover {color:#fff; background-color: #15a589;}
    .p2 { padding: 10px 0; }
    .p3 {width: 100%; display: inline-block; padding-top:110px;}
    .p4 {width: 100%; display: inline-block; padding-top:280px;}
    dl dd {text-align: center;}
</style>
<link rel="stylesheet" href="<?php echo ADMIN_RESOURCE_URL;?>/css/switch.css" type="text/css">

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

    <div class="control_mod widget-shadow"> 
      <div class="form-title">
        <h4>控制模式设置</h4>
      </div>
      <div class="form-body">
        
        <dl>
          <dt>&nbsp;</dt>
          <dd style="width: 100px;">运行频率</dd>
          <dd>模式</dd>
          <dd style="width: 150px;">设定频率</dd>
        </dl>

        <dl>
          <dt>冷冻泵</dt>
          <dd id="ldb_freq" style="width: 100px;">45.0</dd>
          <dd style="text-align: left;">
            <div class="testswitch">
                <input class="testswitch-checkbox" id="onoffswitch_ldb" type="checkbox" >
                <label class="testswitch-label" for="onoffswitch_ldb">
                    <span class="testswitch-inner" data-on="自动" data-off="手动"></span>
                    <span class="testswitch-switch"></span>
                </label>
            </div>
          </dd>
          <dd style="width: 150px;">
                <input type="text" value="45" name="FREQ_LDBEMER" id="FREQ_LDBEMER" class="input-txt"> Hz
          </dd>
        </dl>

        <dl>
          <dt>冷却泵</dt>
          <dd id="lqb_freq" style="width: 100px;">45.0</dd>
          <dd style="text-align: left;">
            <div class="testswitch">
                <input class="testswitch-checkbox" id="onoffswitch_lqb" type="checkbox">
                <label class="testswitch-label" for="onoffswitch_lqb">
                    <span class="testswitch-inner" data-on="自动" data-off="手动"></span>
                    <span class="testswitch-switch"></span>
                </label>
            </div>
          </dd>
          <dd style="width: 150px;">
                <input type="text" value="45" name="FREQ_LQBEMER" id="FREQ_LQBEMER" class="input-txt"> Hz
          </dd>
        </dl>

        <dl>
          <dt>热水泵</dt>
          <dd id="rsb_freq" style="width: 100px;">45.0</dd>
          <dd style="text-align: left;">
            <div class="testswitch">
                <input class="testswitch-checkbox" id="onoffswitch_rsb" type="checkbox">
                <label class="testswitch-label" for="onoffswitch_rsb">
                    <span class="testswitch-inner" data-on="自动" data-off="手动"></span>
                    <span class="testswitch-switch"></span>
                </label>
            </div>
          </dd>
          <dd style="width: 150px;">
          <input type="text" value="45" name="FREQ_RSBEMER" id="FREQ_RSBEMER" class="input-txt"> Hz
          </dd>
        </dl>
        <p style="width: 100%; text-align: center; padding-top: 20px;">
        <a href="javascript:;" onclick="emer_set()"  class="btn" style="float: none;">保存设置 </a>
        </p>
      </div>
    </div>

    <div class="pl_setting widget-shadow" style="margin-right: 0;"> 
      <div class="form-title">
        <h4>预加压设置</h4>
      </div>
      <div class="form-body" style="">
        
      <dl>
          <dt>&nbsp;</dt>
          <dd style="width: 150px;">反馈值</dd>
          <dd>设置值</dd>
        </dl>

        <dl>
          <dt>冷冻泵预加压时间</dt>
          <dd style="width: 150px;" id="LDBPreTime">&nbsp;</dd>
          <dd><input type="text" value="30" name="PRETIME_LDB" id="PRETIME_LDB" class="input-txt"></dd>分钟
        </dl>
        <dl>
          <dt>冷冻泵预加压频率</dt>
          <dd style="width: 150px;" id="LDBPreFreq">&nbsp;</dd>
          <dd><input type="text" value="48" name="PREFREQ_LDB" id="PREFREQ_LDB" class="input-txt"></dd>Hz
        </dl>
        <dl>
          <dt>冷却泵预加压时间</dt>
          <dd style="width: 150px;" id="LQBPreTime">&nbsp;</dd>
          <dd><input type="text" value="10" name="PRETIME_LQB" id="PRETIME_LQB" class="input-txt"></dd>分钟
        </dl>
        <dl>
          <dt>冷却泵预加压频率</dt>
          <dd style="width: 150px;"  id="LQBPreFreq">&nbsp;</dd>
          <dd><input type="text" value="48" name="PREFREQ_LQB" id="PREFREQ_LQB" class="input-txt"></dd>Hz
        </dl>
        <p style="width: 100%; text-align: center; padding-top: 20px;">
        <a href="javascript:;" onclick="pre_set()"  class="btn" style="float: none;">保存设置 </a>
        </p>
      </div>
    </div>


    <div class="pl_setting widget-shadow" style="clear: both;"> 
      <div class="form-title">
        <h4>模式切换</h4>
      </div>
      <div class="form-body" style="padding:3em 2em 3.3em 2em;">
        
        <dl>
            <dt>&nbsp;</dt>
            <dd style="width: 160px;">当前模式</dd>
            <dd>模式设置</dd>
        </dl>

        <dl>
          <dt>冬夏切换</dt>
          <dd style="width: 160px;" id="season_text" data="">&nbsp;</dd>
          <dd>
            <div class="testswitch" style="width: 110px;">
                <input class="testswitch-checkbox" id="onoffswitch_season" type="checkbox">
                <label class="testswitch-label" for="onoffswitch_season">
                    <span class="testswitch-inner" data-on="夏季模式" data-off="冬季模式"></span>
                    <span class="meswitch-switch"></span>
                </label>
            </div>
          </dd>
        </dl>
        <dl>
          <dt>系统群控</dt>
          <dd style="width: 160px;" id="sysac_text" data="">&nbsp;</dd>
          <dd>
            <div class="testswitch" style="width: 110px;">
                <input class="testswitch-checkbox" id="onoffswitch_sysac" type="checkbox">
                <label class="testswitch-label" for="onoffswitch_sysac">
                    <span class="testswitch-inner" data-on="自动群控" data-off="手动运行"></span>
                    <span class="meswitch-switch"></span>
                </label>
            </div>
          </dd>
        </dl>
        <dl>
          <dt>冷却塔自控</dt>
          <dd style="width: 160px;" id="lqtac_text" data="">&nbsp;</dd>
          <dd>
            <div class="testswitch" style="width: 110px;">
                <input class="testswitch-checkbox" id="onoffswitch_lqtac" type="checkbox">
                <label class="testswitch-label" for="onoffswitch_lqtac">
                    <span class="testswitch-inner" data-on="自动控制" data-off="手动控制"></span>
                    <span class="meswitch-switch"></span>
                </label>
            </div>
          </dd>
        </dl>
        <p style="width: 100%; text-align: center; padding-top: 20px;">
        <a href="javascript:;" onclick="mod_set()"  class="btn" style="float: none;">保存设置 </a>
        </p>
      </div>
    </div>

      
  </div>

</div>

<script>

//获取页面数据
$(function(){
    $.ajax({
        url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getMsgObject",
        type: "get",
        timeout : 500,
        dataType: "json",
        data: {msg_name: "ACEGUIState"},
        success: function (t) {//console.log(t)
            if( t.status == 1 ) {

                var SysInfo = t.data.MSGOBJ.ACEGUIState.SysInfo[0] ;
                //console.log(SysInfo);
                //第1位：冷冻泵；第2位：冷却泵；第3位：热水泵（0-自动，1-手动）
                var ldb_mod = (SysInfo.ControlMode & 1) ? 1 : 0;
                var lqb_mod = (SysInfo.ControlMode & 2) ? 1 : 0;
                var rsb_mod = (SysInfo.ControlMode & 4) ? 1 : 0;
                //控制模式频率显示
                var ldb_freq = (ldb_mod == 1) ? SysInfo.LDBEFreq : SysInfo.LDBAFreq1;
                var lqb_freq = (lqb_mod == 1) ? SysInfo.LQBEFreq : SysInfo.LQBAFreq1;
                var rsb_freq = (rsb_mod == 1) ? SysInfo.RSBEFreq : SysInfo.RSBAFreq1;
                $("#ldb_freq").html(ldb_freq);
                $("#lqb_freq").html(lqb_freq);
                $("#rsb_freq").html(rsb_freq);
                //自动/手动显示
                if( ldb_mod == 0 ) {
                    $("#onoffswitch_ldb").attr('checked','true');
                } 
                if( lqb_mod == 0 ) {
                    $("#onoffswitch_lqb").attr('checked','true');
                } 
                if( rsb_mod == 0 ) {
                    $("#onoffswitch_rsb").attr('checked','true');
                }
                
                //预加压显示
                $("#LDBPreTime").html(SysInfo.LDBPreTime);
                $("#LDBPreFreq").html(SysInfo.LDBPreFreq);
                $("#LQBPreTime").html(SysInfo.LQBPreTime);
                $("#LQBPreFreq").html(SysInfo.LQBPreFreq);
                
                //季节模式 1：夏季模式；2：冬季模式
                if( SysInfo.SeasonMode == 1 ) {
                    $("#season_text").html("夏季模式");
                    $("#season_text").attr("data", 1);
                    $("#onoffswitch_season").attr('checked','true');
                } else {
                    $("#season_text").html("冬季模式");
                    $("#season_text").attr("data", 2);
                }
                //系统群控 1, 手动控制 0
                if( SysInfo.SystemACFlag == 1 ) {
                    $("#sysac_text").html("自动群控");
                    $("#sysac_text").attr("data", 1);
                    $("#onoffswitch_sysac").attr('checked','true');
                } else {
                    $("#sysac_text").html("手动运行");
                    $("#sysac_text").attr("data", 0);
                }
                //冷却塔自控 1, 手动控制 0
                if( SysInfo.LQTACFlag == 1 ) {
                    $("#lqtac_text").html("自动控制");
                    $("#lqtac_text").attr("data", 1);
                    $("#onoffswitch_lqtac").attr('checked','true');
                } else {
                    $("#lqtac_text").html("手动控制");
                    $("#lqtac_text").attr("data", 0);
                }
            } 
        }
    });
});

//季节模式切换
function change_season(mod) {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    var change_mod = (mod == 1) ? '夏季模式' : "冬季模式";
    if(confirm('确认切换季节模式为'+change_mod+'吗？')){
        $.ajax({
            url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=ctrlcmd",
            type: "get",
            timeout : 500,
            dataType: "json",
            data: {msg_name: 'SYS_SEASONMODE', msg_value : mod},
            success: function (t) {
                if( t.status == '1' ) {
                    //alert("操作成功");
                    window.location.reload();
                } else {
                    //alert("操作失败");
                }
            }
        });
    }
}
//控制模式设置
// FREQ_LDBEMER = nLDBSetFreq;
// 	FREQ_LQBEMER = nLQBSetFreq;
// 	FREQ_RSBEMER = nRSBSetFreq;

// 	SYS_CTRLMODE = nControlMode;

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
                var emer = ['FREQ_LDBEMER','FREQ_LQBEMER','FREQ_RSBEMER'];
                var eswtich = ['onoffswitch_ldb','onoffswitch_lqb','onoffswitch_rsb'];
                for ( var i=0; i < emer.length; i++ ) {
                    var id = emer[i];
                    var sw = eswtich[i];
                    if( $("#"+id).val() != '' && !$("#"+sw).prop('checked') ) {
                        $.ajax({
                            url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=ctrlcmd",
                            type: "get",
                            timeout : 500,
                            dataType: "json",
                            data: { msg_name: id, msg_value : $("#"+id).val() },
                            success: function (t) {
                                if( t.status == '1' ) {
                                    //alert("操作成功");
                                } else {
                                    //alert("操作失败");
                                }
                            }
                        });
                    }
                }
                //控制模式
                var c_model = 0;
                if( !$("#onoffswitch_ldb").prop('checked') ) {
                    c_model = c_model | 1;
                }
                if( !$("#onoffswitch_lqb").prop('checked') ) {
                    c_model = c_model | 2;
                }
                if( !$("#onoffswitch_rsb").prop('checked') ) {
                    c_model = c_model | 4;
                }
                $.ajax({
                    url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=ctrlcmd",
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
//预加压设置
function pre_set() {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    layer.alert("确认保存预加压设置吗？", 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "预加压设置",
            yes:function(index){
                var pre = ['PRETIME_LDB','PREFREQ_LDB','PRETIME_LQB','PREFREQ_LQB'];
                for ( var i=0; i < pre.length; i++ ) {
                    var id = pre[i];
                    if( $("#"+id).val() != '' ) {
                        $.ajax({
                            url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                            type: "get",
                            timeout : 500,
                            dataType: "json",
                            data: { msg_name: id, msg_value : $("#"+id).val() },
                            success: function (t) {
                                if( t.status == '1' ) {
                                } else {
                                }
                            }
                        });
                    }
                }
                layer.close(index);
            },
            btn2:function(){
                return ;
            }
        }
    );
}

function mod_set() {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    layer.alert('确认保存模式切换的设置吗', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "模式切换",
            yes:function(index){
                //季节模式
                var season = $("#onoffswitch_season").prop('checked') ? "1" : "2";
                if( parseInt(season) != parseInt($("#season_text").attr("data")) ) {
                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {msg_name: 'SYS_SEASONMODE', msg_value : season},
                        success: function (t) {
                            if( t.status == '1' ) {
                            } else {
                            }
                        }
                    });
                }
                //系统群控
                var sysac = $("#onoffswitch_sysac").prop('checked') ? "1" : "0";
                if ( parseInt(sysac) != parseInt($("#sysac_text").attr("data")) ) {
                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {msg_name: 'SYS_SSTTEMACFlag', msg_value : sysac},
                        success: function (t) {
                            if( t.status == '1' ) {
                            } else {
                            }
                        }
                    });
                }
                //冷却塔自控
                var lqtac = $("#onoffswitch_lqtac").prop('checked') ? "1" : "0";
                if ( parseInt(lqtac) != parseInt($("#lqtac_text").attr("data")) ) {
                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/modules/system/index.php?act=device_control&op=ctrlcmd",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {msg_name: 'SYS_LQTACFLAG', msg_value : lqtac},
                        success: function (t) {
                            if( t.status == '1' ) {
                            } else {
                            }
                        }
                    });
                }

                layer.close(index);

            },
            btn2:function(){
                return ;
            }
        }
    );
}

</script>