$(document).ready(function () {
    module_id = $("#report-b-selecter option:eq(0)").get(0).value;
    $.ajax({
        url: 'controller/ajax/report_b.php',
        type: 'GET',
        data: 'module_id=' + module_id,
        dataType: 'json',
        success: function (aData) {
            chargerGraph(aData);
        }
    });
    $("#report-b-selecter").on("change", function () {
        module_id = this.value;
        $.ajax({
            url: 'controller/ajax/report_b.php',
            type: 'GET',
            data: 'module_id=' + module_id,
            dataType: 'json',
            success: function (aData) {
                chargerGraph(aData);
            }
        });
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
            max: 100
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
        series:
                data[1]
    });
}
;