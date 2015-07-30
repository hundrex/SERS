$(document).ready(function () {
    module_id = $("#report-e-selecter option:eq(0)").get(0).value;
    var myData = $.ajax({
        url: 'controller/ajax/report_e.php',
        type: 'GET',
        dataType: 'json',
        data: 'module_id=' + module_id,
        success: function (aData) {
            var mySeries = aData;
            chargerTable(mySeries);
        }
    });

    $("#report-e-selecter").on("change", function () {
        module_id = this.value;
        $.ajax({
            url: 'controller/ajax/report_e.php',
            type: 'GET',
            data: 'module_id=' + module_id,
            dataType: 'json',
            success: function (aData) {
                chargerTable(aData);
            }
        });
    });
});

function chargerTable(data) {
    $("#panel-title-module").html(data[0].module_label);
    $('#table-module-students > tbody').html('');
    for (var key in data[1]) {
        var user = data[1][key];
        if (user.data[0] !== undefined) {
            var row = '<td>' + user.data[0].data + '</td><td>' + user.data[1].data + '</td><td>' + user.data[2].data + '</td>';
            $('#table-module-students > tbody:last').append('<tr>' + row + '</tr>');
        }
    }
}
;
