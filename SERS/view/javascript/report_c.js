$(document).ready(function () {
    var myData = $.ajax({
        url: 'controller/ajax/report_c.php',
        type: 'POST',
        dataType: 'json',
        success: function (aData) {
            var mySeries = aData;
            console.debug(mySeries);
            chargerGraph(mySeries);
        }
    });
});

function chargerGraph(data) {
    $('#report_c-container').highcharts({
        chart: {
            type: 'column',
            backgroundColor: '#ffffff'
        },
        title: {
            text: 'Student passing / failling percentage'
        },
        colors: [
            'green',
            '#72AE00',
            '#72AE00'
        ],
        xAxis: {
            categories: data[0]
        },
        yAxis: {
            title: {
                text: 'Marks'
            },
            stackLabels: {
                enabled: true
            },
            max: 100
        },
        legend: {
            enabled: false
        },
        tooltip: {
            borderColor: '#AAAAAA',
            headerFormat: '<span style="font-size:14px; font-weight:bold">{point.key}</span><table>',
            pointFormat: '' +
                    '<tr> ' +
                    '<td style="padding:1px;padding-right:5px;">{series.name}: </td>' +
                    '<td style="padding:1px;padding-right:5px;">' +
                    '<span style="color:{point.color}; font-weight:bold">{point.y:.1f}</span>%' +
                    '</td>' +
                    '</tr>',
            footerFormat: '</table>',
            hideDelay: 200,
            shared: true,
            useHTML: true
        },
         plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                  enabled: true
              }
            }
        },
        series:
                data[1]
    });
}
;

