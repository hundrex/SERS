<script type="text/javascript" src="./view/javascript/report_b.js"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php'); ?>

<div class="row filter-bar">
    <div class="col-lg-6">
        <div class="input-group">
            <?php $modules = ModuleDAL::findAll(); ?> 
            <span class="input-group-addon" id="moduleSelecterReportb">Module</span>
            <select class="form-control" id="report-b-selecter" name="module">
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
        <button type="button" class="btn btn-default btn-right">Display</button>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Graph</h3>
    </div>
    <div class="panel-body">
        <div id="report_b-container" class="report-40">

        </div>
    </div>
</div>