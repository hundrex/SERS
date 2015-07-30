<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_STUDENT): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');
    $module_id = filter_input(INPUT_GET, 'module_id', FILTER_SANITIZE_NUMBER_INT);
    $module = ModuleDAL::findById($module_id);
    $students = UserDAL::findAllByModule($module);
    $studentCurrent = UserDAL::findById($_SESSION['user']);
    ?>

    <div class="row">
        <div class="col-lg-6">
            <div class="input-group">
                <label for="title">
                    <h4>
                        <?php
                        echo $module->getLabel();
                        ?>
                    </h4>
                </label>
                <p>
                    <?php
                    echo $module->getDescription();
                    ?>
                </p>
            </div>
        </div>
        <div class="col-lg-6">
            <?php if ($_SESSION['role'] <= User::TYPE_USER_TEACHER): ?>
                <div class="input-group input-right hidden">
                    <button type="button" class="btn btn-danger  btn-right">
                        <span class="glyphicon glyphicon-trash"></span></button>
                    <button type="button" class="btn btn-primary btn-right">
                        <span class="glyphicon glyphicon-pencil"></span></button>
                </div>
            <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
                <div class="input-group pull-right">
                    <label for="finalMark">
                        Final mark: 
                        <span class="mark-size">
                            <?php
                            echo $studentCurrent->getNoteModuleFinal($module_id);
                            ?>
                        </span>
                        <br/>
                        Final grade: 
                        <span class="mark-size">
                            <?php
                            if ($studentCurrent->getNoteModuleFinal($module_id) >= 90)
                            {
                                echo 'A+';
                            }
                            elseif ($studentCurrent->getNoteModuleFinal($module_id) >= 80 && $studentCurrent->getNoteModuleFinal($module_id) < 90)
                            {
                                echo 'A';
                            }
                            elseif ($studentCurrent->getNoteModuleFinal($module_id) >= 70 && $studentCurrent->getNoteModuleFinal($module_id) < 80)
                            {
                                echo 'B';
                            }
                            elseif ($studentCurrent->getNoteModuleFinal($module_id) >= 60 && $studentCurrent->getNoteModuleFinal($module_id) < 70)
                            {
                                echo 'C';
                            }
                            elseif ($studentCurrent->getNoteModuleFinal($module_id) >= 50 && $studentCurrent->getNoteModuleFinal($module_id) < 60)
                            {
                                echo 'D';
                            }
                            elseif ($studentCurrent->getNoteModuleFinal($module_id) < 50)
                            {
                                echo 'Fail';
                            }
                            ?>
                        </span>
                    </label>
                </div>
            <?php endif ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <div class="title pull-left">
                        <h4> Assignment </h4>
                    </div>
                    <div class="option pull-right">
                        <?php if ($_SESSION['role'] <= User::TYPE_USER_TEACHER): ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalViewAssign" >
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
                            <span class="panel-mark">
                                Assignment mark:
                                <span class="mark-size">
                                    <?php
                                    echo $studentCurrent->getNoteStudentAssignment($module_id);
                                    ?>
                                </span> <br/>
                                Assignment grade:
                                <span class="mark-size">
                                    <?php
                                    if ($studentCurrent->getNoteStudentAssignment($module_id) >= 90)
                                    {
                                        echo 'A+';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) >= 80 && $studentCurrent->getNoteStudentAssignment($module_id) < 90)
                                    {
                                        echo 'A';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) >= 70 && $studentCurrent->getNoteStudentAssignment($module_id) < 80)
                                    {
                                        echo 'B';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) >= 60 && $studentCurrent->getNoteStudentAssignment($module_id) < 70)
                                    {
                                        echo 'C';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) >= 50 && $studentCurrent->getNoteStudentAssignment($module_id) < 60)
                                    {
                                        echo 'D';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) >= 40 && $studentCurrent->getNoteStudentAssignment($module_id) < 50)
                                    {
                                        echo 'E';
                                    }
                                    elseif ($studentCurrent->getNoteStudentAssignment($module_id) < 40)
                                    {
                                        echo 'Fail';
                                    }
                                    ?>
                                </span>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <label for="assignmentTitle">
                            <?php
                            echo $module->getAssignment()->getLabel();
                            ?>
                        </label>
                    </div>
                    <div class="col-lg-6 panel-mark">
                        <?php
                        echo $module->getAssignment()->getDatePassage();
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo $module->getAssignment()->getDescription();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <div class="title pull-left">
                        <h4> Exam </h4>
                    </div>
                    <div class="option pull-right">
                        <?php if ($_SESSION['role'] <= User::TYPE_USER_TEACHER): ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalViewExam">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
                            <span class="panel-mark"> 
                                Exam mark:
                                <span class="mark-size">
                                    <?php
                                    echo $studentCurrent->getNoteStudentExam($module_id);
                                    ?> 
                                </span>
                                <br/>
                                Exam grade:
                                <span class="mark-size">
                                    <?php
                                    if ($studentCurrent->getNoteStudentExam($module_id) >= 90)
                                    {
                                        echo 'A+';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) >= 80 && $studentCurrent->getNoteStudentExam($module_id) < 90)
                                    {
                                        echo 'A';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) >= 70 && $studentCurrent->getNoteStudentExam($module_id) < 80)
                                    {
                                        echo 'B';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) >= 60 && $studentCurrent->getNoteStudentExam($module_id) < 70)
                                    {
                                        echo 'C';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) >= 50 && $studentCurrent->getNoteStudentExam($module_id) < 60)
                                    {
                                        echo 'D';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) >= 40 && $studentCurrent->getNoteStudentExam($module_id) < 50)
                                    {
                                        echo 'E';
                                    }
                                    elseif ($studentCurrent->getNoteStudentExam($module_id) < 40)
                                    {
                                        echo 'Fail';
                                    }
                                    ?>
                                </span>
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <label for="examTitle">
                            <?php
                            echo $module->getExam()->getLabel();
                            ?>
                        </label>
                    </div>
                    <div class="col-lg-6 panel-mark">
                        <?php
                        echo $module->getExam()->getDatePassage();
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo $module->getExam()->getDescription();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($_SESSION['role'] <= User::TYPE_USER_TEACHER): ?>

        <div class="panel panel-default">
            <div class="panel-heading"><h4> Students marks </h4></div>
            <table class="table">
                <tr><th>Last Name</th><th>First Name</th><th>Assignment mark</th><th>Exam mark</th><th>Final mark</th></tr>
                <?php
                foreach ($students as $student)
                {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $student->getNom();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $student->getPrenom();
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $student->getNoteStudentAssignment($module_id);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $student->getNoteStudentExam($module_id);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $student->getNoteStudentFinal($module_id);
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="center">
            <nav>
                <button type="button" class="btn btn-default  btn-right" data-toggle="modal" 
                        data-target="#modalAddMarks">
                    Add / Edit marks
                </button>
            </nav>
        </div>
    <?php endif;
    ?>


    <div class="modal fade" id="modalAddMarks" 
         tabindex="-1" role="dialog" aria-labelledby="modalAddMarks" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method=POST action="./controller/page/add_notes.php"> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalViewStudentList">
                            Add / Edit marks
                        </h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr><th>Last Name</th><th>First Name</th><th>Assignment mark</th><th>Exam mark</th><th>Final mark</th></tr>
                            <?php
                            foreach ($students as $student)
                            {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $student->getNom();
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $student->getPrenom();
                                        ?>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name=<?php
                                            echo 'studentAssignementNoteEdit-' . $student->getId();
                                            ?>  
                                                   id=<?php
                                                   echo 'studentAssignementNoteEdit-' . $student->getId();
                                                   ?> 
                                                   class="form-control" required
                                                   value=
                                                   <?php
                                                   echo $student->getNoteStudentAssignment($module_id);
                                                   ?>
                                                   aria-describedby=<?php
                                                   echo 'studentAssignementNoteEdit-' . $student->getId();
                                                   ?> >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name=<?php
                                            echo 'studentExamNoteEdit-' . $student->getId();
                                            ?>  
                                                   id=<?php
                                                   echo 'studentExamNoteEdit-' . $student->getId();
                                                   ?> 
                                                   class="form-control" required
                                                   value=
                                                   <?php
                                                   echo $student->getNoteStudentExam($module_id);
                                                   ?>
                                                   aria-describedby=<?php
                                                   echo 'studentExamNoteEdit-' . $student->getId();
                                                   ?> >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name=<?php
                                            echo 'studentFinalNoteEdit-' . $student->getId();
                                            ?>  
                                                   id=<?php
                                                   echo 'studentFinalNoteEdit-' . $student->getId();
                                                   ?> 
                                                   class="form-control" required
                                                   value=
                                                   <?php
                                                   echo $student->getNoteStudentFinal($module_id);
                                                   ?>
                                                   aria-describedby=<?php
                                                   echo 'studentFinalNoteEdit-' . $student->getId();
                                                   ?> >
                                        </div>
                                    </td>
                                </tr>
                                <input type="text" name="id" class="hidden" value="<?php echo $student->getId(); ?>">
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalViewAssign"
         tabindex="-1" role="dialog" aria-labelledby="modalViewAssign" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method=GET action="./controller/page/assign_edit.php"> 
                    <input class="hidden" name="assign_id" value="<?php echo $module->getAssignment()->getId(); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalViewModuleList">Assignment</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>
                                <dl class="dl-horizontal">
                                    <div class="form-group">
                                        <label for="firstNameEdit">Label</label>
                                        <input type="text" name="assign_label" class="form-control" required
                                               value="<?php echo $module->getAssignment()->getLabel(); ?>"
                                               aria-describedby="assign_label">
                                    </div>
                                </dl>
                            </li>
                            <li>
                                <dl class="dl-horizontal">
                                    <div class="form-group">
                                        <label for="firstNameEdit">Description</label>
                                        <textarea type="text" name="assign_desc" class="form-control" required
                                                  aria-describedby="assign_desc"><?php
                                                      echo $module->getAssignment()->getDescription();
                                                      ?> </textarea>
                                    </div>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalViewExam"
         tabindex="-1" role="dialog" aria-labelledby="modalViewAssign" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method=GET action="./controller/page/exam_edit.php"> 
                    <input class="hidden" name="assign_id" value="<?php echo $module->getExam()->getId(); ?>">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modalViewModuleList">Exam</h4>
                    </div>
                    <div class="modal-body">
                        <ul class="list-unstyled">
                            <li>
                                <dl class="dl-horizontal">
                                    <div class="form-group">
                                        <label for="firstNameEdit">Label</label>
                                        <input type="text" name="assign_label" class="form-control" required
                                               value="<?php echo $module->getExam()->getLabel(); ?>"
                                               aria-describedby="assign_label">
                                    </div>
                                </dl>
                            </li>
                            <li>
                                <dl class="dl-horizontal">
                                    <div class="form-group">
                                        <label for="firstNameEdit">Description</label>
                                        <textarea type="text" name="assign_desc" class="form-control" required
                                                  aria-describedby="assign_desc"><?php
                                                      echo $module->getExam()->getDescription();
                                                      ?> </textarea>
                                    </div>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Edit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endif;
