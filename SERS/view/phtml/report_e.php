<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php'); ?>
<script type="text/javascript" src="./view/javascript/report_e.js"></script>

<div class="row filter-bar">
    <div class="col-lg-6">
        <div class="input-group">
            <?php $modules = ModuleDAL::findAll(); ?> 
            <span class="input-group-addon" id="moduleSelecterReportE">Module</span>
            <select id="report-e-selecter" class="form-control">
                <?php foreach ($modules as $module): ?>
                    <option value="<?php echo $module->getId(); ?>">
                        <?php echo $module->getLabel(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <button type="button" class="btn btn-default btn-right"><span class="glyphicon glyphicon-print"></span></button>
    </div>
</div>

<?php
$mesStudents = UserDAL::findAllStudent();
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 id="panel-title-module" class="panel-title">
            <?php
                echo $modules[0]->getLabel();
            ?>
        </h3>
    </div>
    <table class="table">
        <tr>
            <th>Last Name</th><th>First Name</th><th>Result</th>
        </tr>
        <?php
        ?>
        <tr>
            <td>Durden</td><td>Taylor</td><td>Fail</td>
        </tr>

    </table>
</div>