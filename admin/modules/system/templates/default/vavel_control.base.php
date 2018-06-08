<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body { color: #fff; }
    .fixed-bar {padding-bottom: 8px;}
    .content{ width: 100%; height: 718px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y; padding-top: 120px; }
    .content dl {width: 230px; margin: 0 0 20px 30px; border: 2px solid #4bc7eb; float: left;}
    .content dl dt { height: 46px; font-size: 20px; line-height: 46px; text-align:center; border-bottom: 2px solid #4bc7eb; }
    .content dl dd { height: 56px; }
    .content dl dd img { padding: 15px 10px 10px 20px;  }
    .content dl dd div {float: left;}
    .content dl dd div.box { width: 114px; display:inline; border-right: 2px solid #4bc7eb;  }
    .content dl dd div.box_text { font-size: 20px; width: 30px; padding-top: 20px; }
    .content a {color: #fff;}
</style>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>阀门控制</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>

  <div class="content">
    
      <?php foreach( $output['vavel'] as $key => $val) { ?>
      <?php 
        foreach( $val as $k => $v) { 
            $index = $k + 1;
      ?>
      <dl>
        <dt><?php echo $v;?></dt>
        <dd>
          <a href="javascript:;" onclick="turn(<?php echo $index;?>, 1)" id="kai_<?php echo $index;?>" data-commond = "<?php echo $key;?>"><div class="box"><div class="box_img"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Open_N.png"></div> <div class="box_text">开</div> </div></a>
          <a href="javascript:;" onclick="turn(<?php echo $index;?>, 0)" id="guan_<?php echo $index;?>" data-commond = "<?php echo $key;?>"><div class="box" style="border:none;"><div class="box_img"><img src="<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Close_N.png"></div> <div class="box_text">关</div> </div> </a>
        </dd>
      </dl>
      <?php } ?>
      <?php } ?>
      

      
  </div>

</div>

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
            data: {msg_name: "ESwitchState"},
            success: function (t) {
                if( t.status == 1 ) {

                    var ESwitchState = t.data.MSGOBJ.ESwitchState[0] ;

                    for( i=0; i<16; i++ ){
                        var idx = parseInt(i) + parseInt(1);
                        var j = 1 << i;
                        var func = "";

                        if( ESwitchState.FeedOn & j ) {
                            func = "turn("+idx+", 0)";
                            $("#kai_" + idx + " .box_img img").attr("src", "<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Open_Y.png");
                            $("#guan_" + idx + " .box_img img").attr("src", "<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Close_N.png");
                            $("#kai_" + idx).attr('onclick', '');
                            $("#guan_" + idx).attr('onclick', func);
                        }
                        else
                        {
                            func = "turn("+idx+", 1)";
                            $("#guan_" + idx + " .box_img img").attr("src", "<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Close_Y.png");
                            $("#kai_" + idx + " .box_img img").attr("src", "<?php echo ADMIN_RESOURCE_URL;?>/image/FM_Open_N.png");
                            $("#guan_"+idx).attr('onclick', '');
                            $("#kai_" + idx).attr('onclick', func);
                        }
                    }
                } 
            }
        });
    }
});

/**
 * 开关操作
 * @param idx 索引
 * @param flag 1开 0 关
 */
function turn(idx, flag) {
    if ( checkPermis() == 0 ) {
        layer.msg('没有操作权限');
        return false;
    }
    layer.alert('确认操作这个阀门吗', 
        {
            skin: 'layui-layer-molv',
            closeBtn: 1,
            anim: 1,
            btn: ['确认','取消'],
            icon: 6,
            title : "阀门控制",
            yes:function(index){
                var commond = "SWITCH_ESS1-" + idx;
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