<?php defined('ByAcesoft') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>报表查询</h3>
        <h5><?php echo C("project"); ?></h5>
      </div>
      <?php echo $output['top_link'];?>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>通过选择“冷冻机组”、“分项电耗”，“年总能耗”，等关键词，调出相关设备系统的运行报表。</li>
    </ul>
  </div>
  <div id="flexigrid"></div>
  <div class="ncap-search-ban-s" id="searchBarOpen"><i class="fa fa-search-plus"></i>高级搜索</div>
  <div class="ncap-search-bar">
    <div class="handle-btn" id="searchBarClose"><i class="fa fa-search-minus"></i>收起边栏</div>
    <div class="title">
      <h3>高级搜索</h3>
    </div>
    <form method="get" name="formSearch" id="formSearch">
      <div id="searchCon" class="content">
        <div class="layout-box">
          <dl>
            <dt>操作人</dt>
            <dd>
             <input type="text" value="" name="admin_name" class="s-input-txt">
            </dd>
          </dl>
          <dl>
            <dt>操作内容</dt>
            <dd>
             <input type="text" value="" name="content" class="s-input-txt">
            </dd>
          </dl>
          <dl>
            <dt>IP</dt>
            <dd>
             <input type="text" value="" name="ip" class="s-input-txt">
            </dd>
          </dl>
          <dl>
            <dt>操作时间</dt>
            <dd>
              <label>
                <input readonly id="query_start_date" placeholder="请选择起始时间" name=query_start_date value="" type="text" class="s-input-txt" />
              </label>
              <label>
                <input readonly id="query_end_date" placeholder="请选择结束时间" name="query_end_date" value="" type="text" class="s-input-txt" />
              </label>
            </dd>
          </dl>
        </div>
      </div>
      <div class="bottom"> <a href="javascript:void(0);" id="ncsubmit" class="ncap-btn ncap-btn-green mr5">提交查询</a><a href="javascript:void(0);" id="ncreset" class="ncap-btn ncap-btn-orange" title="撤销查询结果，还原列表项所有内容"><i class="fa fa-retweet"></i><?php echo $lang['nc_cancel_search'];?></a></div>
    </form>
  </div>
</div>
<script>
function update_flex(){
    $("#flexigrid").flexigrid({
        url: 'index.php?act=index&op=get_code_xml',
        colModel : [
            {display: '日期', name : 'date', width : 250, sortable : false, align: 'center'},
            {display: '系统总能耗', name : 'collum1',  width : 100, sortable : false, align: 'center'},
            {display: '主机耗能', name : 'collum1', width : 150, sortable : false, align: 'center'},
            {display: '冷冻泵耗能', name : 'collum2',  width : 100, sortable : false, align: 'center'},
            {display: '冷却泵耗能', name : 'collum3',  width : 100, sortable : false, align: 'center'},
            {display: '热水泵耗能', name : 'collum4',  width : 100, sortable : false, align: 'center'},
            {display: '冷却塔耗能', name : 'collum5',  width : 100, sortable : false, align: 'center'}
            ],
        buttons : [
            {display: '导出报表', name : 'add', bclass : 'add', title : '导出报表', onpress : fg_operation_add }
        ],
        
        usepager: true,
        rp: 15,
        title: '冷冻机组报表'
    });
}
function fg_operation_add(name, bDiv){
    var _url = 'index.php?act=index&op=add_channel';
    window.location.href = _url;
}

$(function(){
	update_flex();
});

</script>