<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_TEACHER): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>

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
                    <ul class="list-unstyled">


                        <?php
                        if (sizeof($modules) > 0)
                        {
                            foreach ($modules as $module):
                                ?>
                                <li>
                                    <?php
                                    echo $module->getLabel();
                                    ?>
                                </li>
                                <?php
                            endforeach;
                        }
                        else
                        {
                            echo "User is not registered in any module.";
                        }
                        ?>
                    </ul>
                </td>
                <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" 
                            data-target=<?php echo '"#modalViewStudentList-' . $student->getId() . '"' ?>>
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button> 
                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                            data-target=<?php echo '"#modalEditStudent-' . $student->getId() . '"' ?>>
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button> 
                    <button type="button" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </button> 
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


<!--modals--> 
<?php foreach ($students as $student): ?>
    <div class="modal fade" id="<?php echo 'modalEditStudent-' . $student->getId() ?>" 
         tabindex="-1" role="dialog" aria-labelledby=<?php echo '"modalEditStudent-' . $student->getId() . '"' ?> >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method=POST action="./controller/page/student_edit.php">  
                    <!--todo Alexis : créer student_edit pour traiter la modif-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalEditStudent">
                            <?php
                            echo $student->getNom() . ' ' . $student->getPrenom();
                            ?>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>
                                <div class="form-group">
                                    <label for="lastNameEdit">Last name</label>
                                    <input type="text" name="lastNameEdit" id="lastNameEdit" class="form-control" required
                                           value=
                                           <?php
                                           echo $student->getNom();
                                           ?>
                                           aria-describedby="lastNameEdit">
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="firstNameEdit">First name</label>
                                    <input type="text" name="firstNameEdit" class="form-control" required
                                           value=
                                           <?php
                                           echo $student->getPrenom();
                                           ?> 
                                           aria-describedby="firstNameEdit">
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="pseudoEdit">Pseudo</label>
                                    <input type="text" name="pseudoEdit" class="form-control" required
                                           value=
                                           <?php
                                           echo $student->getPseudo();
                                           ?> 
                                           aria-describedby="pseudoEdit">
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="emailEdit">Email</label>
                                    <input type="text" name="emailEdit" class="form-control" required
                                           value=
                                           <?php
                                           echo $student->getMail();
                                           ?> 
                                           aria-describedby="emailEdit">
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="addressEdit">Address</label>
                                    <input type="text" name="addressEdit" class="form-control" required 
                                           value=
                                           <?php
                                           echo $student->getAdresse();
                                           ?> 
                                           aria-describedby="addressEdit">
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="birthDateEdit">Birth date</label>
                                    <input type="date" name="birthDateEdit" class="form-control" required
                                           value=
                                           <?php
                                           echo $student->getDateNaissance();
                                           ?> 
                                           aria-describedby="birthDateEdit">
                                </div>
                            </li>
                            <li>
                                <input type="text" class="hidden" name="studentId" value="<?php echo $student->getId();?>"> 
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
endforeach;
?>



<?php foreach ($students as $student):
    ?>
    <div class="modal fade" id="<?php echo 'modalViewStudentList-' . $student->getId()?> "
         tabindex="-1" role="dialog" aria-labelledby=<?php echo '"modalViewStudentList-' . $student->getId() . '"' ?> >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalViewStudentList">
                        <?php
                        echo $student->getNom() . ' ' . $student->getPrenom();
                        ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled">
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Avatar: </dt>
                                <dd><img src=<?php
                                    echo '".' . $student->getAvatar()->getType()->getChemin() .
                                    '/' . $student->getAvatar()->getNom() . '"';
                                    ?> ></dd>
                            </dl>
                        </li>
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
                                    <h4>
                                        Module(s) followed
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">

                                        <?php
                                        if (sizeof($modules) > 0)
                                        {
                                            foreach ($modules as $module):
                                                ?>
                                                <li class="list-group-item">
                                                    <h4> 
                                                        <?php echo $module->getLabel(); ?>
                                                    </h4>

                                                    <span> 
                                                        <?php echo $module->getDescription(); ?>
                                                    </span>
                                                </li>
                                                <?php
                                            endforeach;
                                        }
                                        else
                                        {
                                            echo "User is not registered in any module.";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
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
endif;?>