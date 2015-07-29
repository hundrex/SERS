<?php require_once './model/DAL/UserDAL.php'; ?>

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

<?php $students = UserDAL::findAllStudent(); ?>

<div class="panel panel-default">
    <div class="panel-heading">Student list</div>
    <table class="table">
        <tr><th>Last Name</th><th>First Name</th><th>Birth date</th><th>Module Associated</th></tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student->getNom(); ?></td>
            <td><?php echo $student->getPrenom(); ?></td>
            <td><?php echo $student->getDateNaissance(); ?></td>
            <td><?php $modules = $student->getModule(); ?>
                <?php
                if (sizeof($modules) > 0) {
                foreach ($modules as $module):
                echo $module->getLabel() . "; ";
                endforeach;
                }
                else {
                echo "User is not registered in any module.";
                }
                ?>
            </td>
            <td>
                <button type="button" class="btn btn-default" data-toggle="modal" 
                        data-target=<?php echo '"#modalViewUserList-' . $student->getId() . '"' ?>>
                    <span class="glyphicon glyphicon-eye-open"></span></button> 
            </td>
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
<?php foreach ($students as $student): ?>
<div class="modal fade" id=<?php echo '"modalViewUserList-' . $student->getId() . '"' ?> 
     tabindex="-1" role="dialog" aria-labelledby=<?php echo '"modalViewUserList-' . $student->getId() . '"' ?> >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalViewStudentList">
                    <?php
                    echo $student->getNom();
                    echo ' ';
                    echo $student->getPrenom();
                    ?>
                </h4>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Pseudo: </dt>
                            <dd><?php echo $student->getPseudo(); ?></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Email: </dt>
                            <dd><?php echo $student->getMail(); ?></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Address: </dt>
                            <dd><?php echo $student->getAdresse(); ?></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Birth date: </dt>
                            <dd><?php echo $student->getDateNaissance(); ?></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Creation date: </dt>
                            <dd><?php echo $student->getDateCreation(); ?></dd>
                        </dl>
                    </li>
                    <li>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Module(s) followed
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <?php
                                        if (sizeof($modules) > 0) {
                                        foreach ($modules as $module):
                                        ?>
                                        <dl class="dl-horizontal">
                                            <dt>
                                                <?php echo $module->getLabel() . "; "; ?>
                                            </dt>
                                            <dd>
                                                <?php echo $module->getDescription() . "; "; ?>
                                            </dd>
                                        </dl>
                                        <?php endforeach; 
                                        }
                                        else {
                                        echo "User is not registered in any module.";
                                        }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <dl class="dl-horizontal">
                            <dt>Avatar: </dt>
                            <dd><img src=<?php
                                echo '".' . $student->getAvatar()->getType()->getChemin() .
                                '/' . $student->getAvatar()->getNom() . '"';
                                ?> ></dd>
                        </dl>
                    </li>
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
