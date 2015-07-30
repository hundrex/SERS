<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_STUDENT): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>

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
                    <?php $nbAssign = $module->getMoyenneAssignment(); ?>
                    <?php $nbExam = $module->getMoyenneExam(); ?>
                    <?php $nbFinal = $module->getMoyenneFinal(); ?>
                    <td><?php echo $module->getLabel(); ?></td>
                    <td><?php echo $module->getDescription(); ?></td>
                    <td>
                        <?php
                        //Affiche moyenne Assignment
                        if ($nbAssign === 0)
                        {
                            echo "--";
                        }
                        else
                        {
                            echo $nbAssign;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        //Affiche moyenne Exam
                        if ($nbExam === 0)
                        {
                            echo "--";
                        }
                        else
                        {
                            echo $nbExam;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        //Affiche Moyenne Final
                        if ($nbAssign === 0 && $nbExam === 0)
                        {
                            echo "--";
                        }
                        else if ($nbAssign === 0 || $nbExam === 0)
                        {
                            echo $nbFinal * 2;
                        }
                        else
                        {
                            echo $nbFinal;
                        }
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-default" data-toggle="modal" 
                                data-target=<?php echo '"#modalViewUserList-' . $module->getId() . '"' ?>>
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
    <?php foreach ($modules as $module): ?>
        <div class="modal fade" id=<?php echo '"modalViewUserList-' . $module->getId() . '"' ?>
             tabindex="-1" role="dialog" aria-labelledby=<?php echo '"modalViewUserList-' . $module->getId() . '"' ?> >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalViewModule">
        <?php echo $module->getLabel(); ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>
                                <dl class="dl-horizontal">
                                    <dt>Number: </dt>
                                    <dd><?php echo $module->getNumber(); ?></dd>
                                </dl>
                            </li>
                            <li>
                                <dl class="dl-horizontal">
                                    <dt>Creation date: </dt>
                                    <dd><?php echo $module->getDateCreation(); ?></dd>
                                </dl>
                            </li>
                            <li>
                                <dl class="dl-horizontal">
                                    <dt>Description: </dt>
                                    <dd><?php echo $module->getDescription(); ?></dd>
                                </dl>
                            </li>
                            <li>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Assignment: <?php echo $module->getAssignment()->getLabel(); ?></div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Description: </dt>
                                                    <dd><?php echo $module->getAssignment()->getDescription(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Due date: </dt>
                                                    <dd><?php echo $module->getAssignment()->getDatePassage(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Retry price: </dt>
                                                    <dd><?php echo $module->getAssignment()->getPrixRattrapage(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Mark: </dt>
                                                    <dd><?php echo $module->getAssignment()->getNote(); ?></dd>
                                                </dl>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Exam: <?php echo $module->getExam()->getLabel(); ?></div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Description: </dt>
                                                    <dd><?php echo $module->getExam()->getDescription(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Due date: </dt>
                                                    <dd><?php echo $module->getExam()->getDatePassage(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Retry price: </dt>
                                                    <dd><?php echo $module->getExam()->getPrixRattrapage(); ?></dd>
                                                </dl>
                                            </li>
                                            <li>
                                                <dl class="dl-horizontal">
                                                    <dt>Mark: </dt>
                                                    <dd><?php echo $module->getExam()->getNote(); ?></dd>
                                                </dl>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <dl class="dl-horizontal">
                                    <dt>Final: </dt>
                                    <dd>
                                        <?php
                                        $noteAssignment = $module->getAssignment()->getNote();
                                        $noteExam = $module->getExam()->getNote();
                                        $noteFinal = ($noteAssignment + $noteExam) / 2;
                                        echo $noteFinal;
                                        ?>
                                    </dd>
                                </dl>
                            </li>


                            <!--                        
                            <li>
                                <dl class="dl-horizontal">
                                    <dt>Students following: </dt>
                                    <dd><?php echo $module->getEleves(); ?></dd>
                                </dl>
                            </li>
                            -->


                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Edit</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>