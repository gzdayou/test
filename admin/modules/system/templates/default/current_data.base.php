<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    body {
        /*background: url("<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg") repeat-y;*/
    }
    .content{width: 100%; height: 838px; background: url('<?php echo ADMIN_RESOURCE_URL;?>/image/source_station_bg.jpg') repeat-y;}
    .page {padding: 62px 0 0 1%;}
    #param_box {border-top: 2px #5e99b7 solid; color: #fff;}
    #box_left, #box_right { position: absolute; margin-top: 20px; }
    #box_left { left: 30px; width: 780px; }
    #box_right { left: 840px; }
    #box_left h3, #box_right h3 {font-size: 26px; }
    #box_left .params { margin-top: 20px; width: 100%; }
    #box_left .params .row{ width: 33%; font-size: 16px; float: left; }
    #box_left .params .row p { margin-bottom: 10px; }
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_3 {position: absolute; top: 424px; left: 145px;}
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


      </div>

      <div id="param_box" >





      </div>
  </div>

</div>
<script type="text/javascript">
$(function(){

});
</script>
