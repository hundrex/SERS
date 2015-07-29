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
                if (!$student->getSuccessModule($moduleId))
                {
                    ?>
                    <tr>
                        <td><?php echo $student->getNom(); ?></td>
                        <td><?php echo $student->getPrenom(); ?></td>
                        <td><?php echo $student->getNoteStudentAssignment($moduleId); ?></td>
                        <td><?php echo $student->getNoteStudentExam($moduleId); ?></td>
                        <td><?php echo $student->getNoteStudentFinal($moduleId); ?></td>
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