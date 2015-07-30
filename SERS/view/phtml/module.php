<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');
$module_id      = filter_input(INPUT_GET, 'module_id', FILTER_SANITIZE_NUMBER_INT);
$module         = ModuleDAL::findById($module_id);
$students       = UserDAL::findAllByModule($module);
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
        <?php if ($_SESSION['role'] == User::TYPE_USER_TEACHER): ?>
            <div class="input-group input-right">
                <button type="button" class="btn btn-danger  btn-right">
                    <span class="glyphicon glyphicon-trash"></span></button>
                <button type="button" class="btn btn-primary btn-right">
                    <span class="glyphicon glyphicon-pencil"></span></button>
            </div>
        <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
            <div class="input-group pull-right">
                <label for="finalMark">
                    <h4>Final mark: 
                        <?php
                        echo $studentCurrent->getNoteStudentFinal($module_id);
                        ?>
                    </h4>
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
                    <?php if ($_SESSION['role'] == User::TYPE_USER_TEACHER): ?>
                        <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
                        <span class="panel-mark">
                            <h4>
                                Assignment mark:
                               <?php
                                echo $studentCurrent->getNoteStudentAssignment($module_id);
                                ?> 
                            </h4>
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
                    <?php if ($_SESSION['role'] == User::TYPE_USER_TEACHER): ?>
                        <button type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    <?php elseif ($_SESSION['role'] == User::TYPE_USER_STUDENT): ?>
                        <span class="panel-mark"> 
                            <h4>
                                Exam mark:
                               <?php
                                echo $studentCurrent->getNoteStudentExam($module_id);
                                ?> 
                            </h4>
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

<?php if ($_SESSION['role'] == User::TYPE_USER_TEACHER): ?>

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
            <button type="button" class="btn btn-default  btn-right">Import marks (.csv) <span 
                    class="glyphicon glyphicon-open-file"></span></button>
        </nav>
    </div>
    <?php




    

 endif ;