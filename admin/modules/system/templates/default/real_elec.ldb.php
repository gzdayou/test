<?php defined('ByAcesoft') or exit('Access Invalid!');?>
<style>
    .content{width: 100%; height: 838px;}
    .page {padding: 62px 0 0 1%;}
    a.ncap-btn-big{font: bold 14px/14px "microsoft yahei", arial;height: 14px;}
    .onoff .cb-enable, .onoff .cb-disable {  font-size: 12px;  line-height: 26px;  height: 26px;  padding: 1px 9px;  border-style: solid; }
    .content #left_3 {position: absolute; top: 424px; left: 145px;}
    table.altrowstable{font-family:verdana,arial,sans-serif;font-size:11px;color:#333;border-width:1px;border-color:#a9c6c9;border-collapse:collapse;width:100%}
    table.altrowstable th{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9;font-weight:bold; font-size: 14px;}
    table.altrowstable td{border-width:1px;padding:8px;border-style:solid;border-color:#a9c6c9}
    .oddrowcolor{background-color:#d4e3e5}
    .evenrowcolor{background-color:#c3dde0}
    #container {height: 838px;}
</style>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
        <div class="subject">
            <h3>实时电量</h3>
            <h5><?php echo C("project"); ?></h5>
        </div>
        <?php echo $output['top_link'];?> </div>
    </div>

    <!-- <div class="search-header">
        <form method="get" action="index.php" target="_self" id="export_form">
            <dl style="margin-left: 20px;">
                <dt>
                    选择日期：
                    <input id="date" name="date" value="<?php echo $output['date']; ?>" class="Wdate" type="text" onclick="WdatePicker({skin:'whyGreen',minDate:'2010-09-10',maxDate:'2050-12-20'})">
                </dt>
                <dd>
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-acidblue" id="submitBtn">查询</a>
                </dd>
            </dl>
            <input type="hidden" name="act" value="energy_report" >
            <input type="hidden" name="export" value="1" >
        </form>
    </div> -->

    <div class="box" id="container">
        <div id="container" style="min-height:400px;height:400px"></div>
    </div>

</div>

<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script src="https://img.hcharts.cn/highcharts/themes/sand-signika.js"></script>
<script>

var categories = [] ;
var data = [] ;

<?php
foreach ( $output['host'] as $k => $v ) {
?>
    categories.push('<?php echo $v['tm']; ?>') ;
    data.push(<?php echo sprintf("%.2f",$v['energy']); ?>) ;
<?php    
}
?>

var max = getMaximin(data, "max") + 500 ;

if( categories.length == 0 ) categories = ["0:00"] ;
if( data.length == 0 ) {
    data = [0] ;
    max = 1000 ;
}

$('#container').highcharts({
    chart: {
		type: 'line'
	},
    title: {
        text: null
    },
    legend : {
        enabled : false
    },
    xAxis: {
        categories: categories
    },
    yAxis: {
        min: 0,
        max: max,
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }],
        title: {
            text: '冷冻泵电量'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: true
        }
    },
    series: [{
        name : "冷冻泵电量" ,
        data: data
    }]
});

</script>
