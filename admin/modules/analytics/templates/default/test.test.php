<?php defined('ByAcesoft') or exit('Access Invalid!');?>

<div id="container" style="min-width:400px;height:400px"></div>
<script src="<?php echo ADMIN_RESOURCE_URL;?>/js/highcharts.js"></script>
<script>

$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
			style: {
                borderWidth: 0
            }
        },
        title: {
            text: ''
        },
        tooltip: {
            headerFormat: '{series.name}<br>',
            pointFormat: '{point.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: '浏览器访问量占比',
            data: [
                ['Firefox',   45.0],
                ['IE',       26.8],
                ['Safari',    8.5],
                ['Opera',     6.2],
                ['其他',   0.7]
            ]
        }]
    });
});

</script>
<!-- 饼图JS结束 -->