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

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});
function activeLastPointToolip(chart) {
    var points = chart.series[0].points;
    chart.tooltip.refresh(points[points.length -1]);
}

$('#container').highcharts({
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {
                // set up the updating of the chart each second
                var series = this.series[0],
                    chart = this;
                var tmp = 0;
                setInterval(function () {

                    $.ajax({
                        url: "<?php echo ADMIN_SITE_URL;?>/index.php?act=common&op=getMsgObject",
                        type: "get",
                        timeout : 500,
                        dataType: "json",
                        data: {msg_name: "HostState"},
                        success: function (t) {
                            var hostinfo = t.data.MSGOBJ.HostState.HostInfo;
                            var x = (new Date()).getTime(), // current time
                                y = hostinfo[0][0].CurEnergy + hostinfo[1][0].CurEnergy + hostinfo[2][0].CurEnergy;
                            // if( y > tmp ) {
                            //     tmp = y;
                            //     chart.series.yAxis = y + 100;
                            // }
                                
                            series.addPoint([x, y], true, true);
                            activeLastPointToolip(chart)
                        }
                    });    

                }, 3000);
            }
        }
    },
    title: {
        text: '主机电量'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: 'KW/h'
        },
        min: 0,
        max: 10000,
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: '主机电量',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;
            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: 0
                });
            }
            return data;
        }())
    }]
}, function(c) {
    activeLastPointToolip(c)
});
</script>
