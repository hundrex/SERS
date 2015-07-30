<script type="text/javascript" src="./view/javascript/report_a.js"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php'); ?>

<div class="row filter-bar">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="input-group">
            <?php $students = UserDAL::findAllStudent(); ?> 
            <span class="input-group-addon" id="sizing-addon1">Student</span>
            <select class="form-control" id="report-a-selecter">
                <?php foreach ($students as $student): ?>
                <option value="<?php echo $student->getId(); ?>">
                        <?php echo $student->getNom() . ' ' . $student->getPrenom(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <button type="button" class="btn btn-default btn-right"><span class="glyphicon glyphicon-print"></span></button>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Graph</h3>
    </div>
    <div class="panel-body">
        <div id="report_a-container"></div>
    </div>
</div>

