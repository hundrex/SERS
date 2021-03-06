<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_TEACHER): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>

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
        <button type="button" class="btn btn-default btn-right hidden"><span class="glyphicon glyphicon-print"></span></button>
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
    <table id="table-module-students" class="table">
        <tbody>
        <tr>
            <th>Last Name</th><th>First Name</th><th>Result</th>
        </tr>
        </tbody>
    </table>
</div>
    <?php endif; ?>
