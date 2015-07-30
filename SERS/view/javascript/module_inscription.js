$(document).ready(function () {
    module_id = $("#module-inscription-selecter option:eq(0)").get(0).value;
    $.ajax({
        url: 'controller/ajax/module_inscription.php',
        type: 'GET',
        data: 'module_id=' + module_id,
        dataType: 'json',
        success: function (aData) {
            chargerTable(aData);
        }
    });
    $("#module-inscription-selecter").on("change", function () {
        module_id = this.value;
        $.ajax({
            url: 'controller/ajax/module_inscription.php',
            type: 'GET',
            data: 'module_id=' + module_id,
            dataType: 'json',
            success: function (aData) {
                chargerTable(aData);
            }
        });
    });
});

function chargerTable(aData) {
    $('#panel-students-module').removeClass('hidden');
    for (var key in aData) {
        var user = aData[key];
        $("#checkbox-eleve-" + user.id).get(0).checked = user.inscrit;
    }
}
;