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
            text: 'Fruit Consumption'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
        }]
    });
};