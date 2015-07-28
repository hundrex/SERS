$(document).ready(function () {
    console.debug('test');
    
    var myData = $.ajax({
        url: 'controller/ajax/report_b.php',
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
    $('#report_b-container').highcharts({
        chart: {
            type: 'column',
            backgroundColor: '#ffffff'
        },
        title: {
            text: 'Student marks for this module'
        },
        xAxis: {
            categories: ['Anderson Thomas', 'Rabbit Roger']
        },
        yAxis: {
            title: {
                text: 'Marks'
            },
            max: 100
        },
        series: [{
            name: 'Final',
            data: [
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'},
                {y : 67.5, color: 'green'}, 
                {y : 50, color: 'red'}
            ]
        }, {
            name: 'Assignment',
            data: [
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}, 
                {y : 35, color: '#FF5454'}, 
                {y : 70, color: '#72AE00'}
            ]
        }, {
            name: 'Exam',
            data: [
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'},
                {y : 100, color: '#72AE00'},
                {y : 30, color: '#FF5454'}
            ]
        }]
    });
};