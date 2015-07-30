<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_TEACHER): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/ModuleDAL.php');
?>

<div class="row filter-bar">
    <div class="col-lg-12">
        <div class="input-group">
            <label for="reportD">Failing students</label>
        </div>
    </div>
</div>

<?php
//recupère tous les module
$mesModules = ModuleDAL::findAll();
//recupère tous les students
$mesStudents = UserDAL::findAllStudent();
?>
<?php
foreach ($mesModules as $module):
    $moduleId = $module->getId();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $module->getLabel(); ?></h3>
        </div>
        <table class="table">
            <tr>
                <th>Last Name</th><th>First Name</th><th>Mark Assignment</th><th>Mark Exam</th><th>Average Module</th>
            </tr>
            <?php
            foreach ($mesStudents as $student):
                if ($student->getSuccessModule($moduleId) == 0)
                {
                    ?>
                    <tr>
                        <td><?php echo $student->getNom(); ?></td>
                        <td><?php echo $student->getPrenom(); ?></td>
                        <?php $noteAssign = $student->getNoteStudentAssignment($moduleId); ?>
                        <?php $noteExam = $student->getNoteStudentExam($moduleId); ?>
                        <?php $noteFinal = $student->getNoteStudentFinal($moduleId); ?>
                        <td>
                            <?php
                            //Affiche note Assignment
                            echo $noteAssign;
                            ?>
                        </td>
                        <td>
                            <?php
                            //Affiche note Exam
                                echo $noteExam;
                            ?>
                        </td>
                        <td>
                            <?php
                            //Affiche Moyenne Final
                            if ($noteAssign === 0 && $noteExam === 0)
                            {
                                echo "--";
                            }
                            else if ($noteAssign === 0 || $noteExam === 0)
                            {
                                echo $noteFinal;
                            }
                            else
                            {
                                echo $noteFinal;
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            endforeach;
            ?>
        </table>
    </div>
<?php endforeach; ?>

<!--
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Web Design</h3>
    </div>
    <table class="table">
        <tr>
            <th>Last Name</th><th>First Name</th>
        </tr>
        <tr>
            <td>Durden</td><td>Taylor</td>
        </tr>
        <tr>
            <td>Anderson</td><td>Thomas</td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Content Management System</h3>
    </div>
    <table class="table">
        <tr>
            <th>Last Name</th><th>First Name</th>
        </tr>
        <tr>
            <td>Durden</td><td>Taylor</td>
        </tr>
        <tr>
            <td>Anderson</td><td>Thomas</td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Legal Ethical Social and Professional Issues</h3>
    </div>
    <table class="table">
        <tr>
            <th>Last Name</th><th>First Name</th>
        </tr>
        <tr>
            <td>Durden</td><td>Taylor</td>
        </tr>
        <tr>
            <td>Anderson</td><td>Thomas</td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Web Development Framework</h3>
    </div>
    <table class="table">
        <tr>
            <th>Last Name</th><th>First Name</th>
        </tr>
        <tr>
            <td>Durden</td><td>Taylor</td>
        </tr>
        <tr>
            <td>Anderson</td><td>Thomas</td>
        </tr>
    </table>
</div>
-->
<?php endif;?>