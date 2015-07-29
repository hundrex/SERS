$(document).ready(function () {
    var myData = $.ajax({
        url: 'controller/ajax/report_a.php',
        type: 'POST',
        dataType: 'json',
        success: function (aData) {
            var mySeries = aData;
            chargerGraph(mySeries);
        }
    });
});

function chargerGraph(data) {
    $('#report_a-container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Student marks'
        },
        colors: [
            'green',
            '#72AE00',
            '#72AE00'
        ],
        xAxis: {
            categories: ['Web Dev', 'M2', 'M3', 'M4']
        },
        yAxis: {
            title: {
                text: 'Marks'
            },
            max: 100
        },
        plotOptions: {
          column: {
              dataLabels: {
                  enabled: true,
                  crop: false,
                  overflow: "none"
              }
          }  
        },
        tooltip: {
            borderColor: '#AAAAAA',
            headerFormat: '<span style="font-size:14px; font-weight:bold">{point.key}</span><table>',
            pointFormat: '' + 
                    '<tr> ' + 
                        '<th style="color:{series.color};padding:1px;padding-right:5px;">{series.name}: </th>' +
                        '<td style="padding:1px;padding-right:5px;">' + 
                            '<span style="color:{point.color}; font-weight:bold">{point.y:.1f}</span>%' + 
                        '</td>' + 
                    '</tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        series: data
    });
};