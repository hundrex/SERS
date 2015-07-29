<?php require_once './model/DAL/UserDAL.php'; ?>
<?php require_once './model/DAL/ModuleDAL.php'; ?>
<?php require_once './model/DAL/AssignmentDAL.php'; ?>
<?php require_once './model/DAL/ExamDAL.php'; ?>

<div class="row filter-bar">
    <div class="col-lg-6">
        <div class="input-group">
            <select class="form-control">
                <option value="All">All</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <span class="input-group-addon" id="sizing-addon1">Items per page</span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
        </div>
    </div>
</div>

<?php $modules = ModuleDAL::findAll(); ?>

<div class="panel panel-default">
    <div class="panel-heading">Module list</div>
    <table class="table">
        <tr><th>Module</th><th>Description</th><th>Assignment</th><th>Exam</th><th>Final</th></tr>
        <?php foreach ($modules as $module): ?>
        <tr>
            <?php $modulId = $module->getId(); ?>
            <?php $nbAssign = AssignmentDAL::findNbAssign($modulId); ?>
            <?php $nbExam = ExamDAL::findNbExam($modulId); ?>
            <?php $nbFinal = $nbAssign + $nbExam; ?>
            <td><?php echo $module->getLabel(); ?></td>
            <td><?php echo $module->getDescription(); ?></td>
            <td><?php echo $nbAssign; ?></td>
            <td><?php echo $nbExam; ?></td>
            <td><?php echo $nbFinal; ?></td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalViewModule">
                    <span class="glyphicon glyphicon-eye-open"></span></button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<nav class="center">
    <ul class="pagination" >
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!--modal--> 
<div class="modal fade" id="modalViewModule" tabindex="-1" role="dialog" aria-labelledby="modalViewModule">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalViewModule">Module view</h4>
            </div>
            <div class="modal-body">
                Module details
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Edit</button>
            </div>
        </div>
    </div>
</div>
