$(document).ready(function () {
    console.debug('test');
    
    var myData = $.ajax({
        url: 'controller/ajax/report_a.php',
        type: 'POST',
        dataType: 'json',
        success: function (aData) {
            var mySeries = aData;
//            var mySeries = getSeries(aData);
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
        tooltip: {
            headerFormat: '<span style="font-size:12px; font-weight:bold">{point.key}</span><table>',
            pointFormat: '' + 
                    '<tr> ' + 
                        '<th style="color:{series.color};padding:3">{series.name}: </th>' +
                        '<td style="padding:3">' + 
                            '<span style="color:{series.color}; font-weight:bold">{point.y:.1f}</span>%' + 
                        '</td>' + 
                    '</tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        series: [{
            name: 'Final',
            data: [
                {y : 77.5, color: 'green'}, 
                {y : 78.5, color: 'green'}, 
                {y : 92, color: 'green'}, 
                {y : 47, color: 'red'}
            ]
        }, {
            name: 'Assignment',
            data: [
                {y : 100, color: '#72AE00'}, 
                {y : 80, color: '#72AE00'}, 
                {y : 100, color: '#72AE00'}, 
                {y : 40, color: '#FF5454'}
            ]
        }, {
            name: 'Exam',
            data: [
                {y : 55, color: '#FF5454'}, 
                {y : 77, color: '#72AE00'}, 
                {y : 84, color: '#72AE00'}, 
                {y : 54, color: '#FF5454'}
            ]
        }]
    });
};