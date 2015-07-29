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
//        chart: {
//            type: 'column'
//        },
//        title: {
//            text: 'Total fruit consumtion, grouped by gender'
//        },
//        xAxis: {
//            categories: ['Module1', 'Module2']
//        },
//        yAxis: {
//            allowDecimals: false,
//            min: 0,
//            title: {
//                text: 'Number of fruits'
//            }
//        },
//        tooltip: {
//            formatter: function () {
//                return '<b>' + this.x + '</b><br/>' +
//                        this.series.name + ': ' + this.y + '<br/>' +
//                        'Total: ' + this.point.stackTotal;
//            }
//        },
//        plotOptions: {
//            column: {
//                stacking: 'normal'
//            }
//        },
//        series: [
//            {
//                name: 'AssignPass',
//                data: [40,20],
//                stack: 'Assignement',
//                color: 'green'
//            }, {
//                name: 'AssignFail',
//                data: [60,80],
//                stack: 'Assignement',
//                color: 'red'
//            }, {
//                name: 'ExamPass',
//                data: [60,80],
//                stack: 'Exam',
//                color: 'green'
//            }, {
//                name: 'ExamFail',
//                data: [40,20],
//                stack: 'Exam',
//                color: 'red'
//            }
//        ]


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
//            categories: data[0]
        },
        yAxis: {
            title: {
                text: 'Marks'
            }
//            max: 100
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
         plotOptions: {
            column: {
                stacking: 'normal'
            }
        },
        series:
                data
    });
}
;

