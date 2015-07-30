<?php
$userNowId = $_SESSION['user'];
$userNow = UserDAL::findById($userNowId);
$userRole = $_SESSION['role'];
?>

<div class="panel panel-default">
    <div class="panel-heading">Personnal information</div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <li>
                    <dl class="dl-horizontal">
                        <dt>Pseudo: </dt>
                        <dd><?php echo $userNow->getPseudo(); ?></dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Last name: </dt>
                        <dd><?php echo $userNow->getNom(); ?></dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>First name: </dt>
                        <dd><?php echo $userNow->getPrenom(); ?></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading clearfix">
        <div class="title pull-left">
            General Information 
        </div>
        <div class="option pull-right">
            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button>
        </div>
    </div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <li>
                    <dl class="dl-horizontal">
                        <dt>Birth date: </dt>
                        <dd><?php echo $userNow->getDateNaissance(); ?></dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Address: </dt>
                        <dd><?php echo $userNow->getAdresse(); ?></dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Email: </dt>
                        <dd><?php echo $userNow->getMail(); ?></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--Differ is student or teacher-->
<?php
if ($userNow->isStudent())
{
    $modulesUser = ModuleDAL::findAllByEleve($userNow);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">Followed modules</div>
        <div class="panel-body">
            <div class="panel-list">
                <ul class="list-unstyled">
                    <?php foreach ($modulesUser as $module):?>
                    <li>
                        <dl class="dl-horizontal">
                            <dt><?php echo $module->getLabel();?></dt>
                            <dd><?php echo $module->getDescription();?></dd>
                        </dl>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php } ?>


<?php
if ($userNow->isEnseignant())
{
    $modulesUser = ModuleDAL::findAllByEnseignant($userNow);
?>
<div class="panel panel-default">
    <div class="panel-heading">Student list for each teached module</div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <?php foreach ($modulesUser as $module):?>
                <?php $students = UserDAL::findAllByModule($module); ?>
                <li>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $module->getLabel();?></div>
                        <div class="panel-body">
                            <div class="panel-list">
                                <ul class="list-unstyled">
                                    <?php foreach ($students as $student):?>
                                    <li>
                                        <?php echo $student->getNom() . " ". $student->getPrenom();?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php } ?>

<form method=POST action="./controller/page/password.php">
    <div class="panel panel-default">
        <div class="panel-heading">Password changing</div>
        <div class="panel-body">
            <div class="form-group">
                <label for="userPasswordProfileOld">Old password</label>
                <input type="password" class="form-control" id="userPasswordProfileOld" name="userPasswordProfileOld" 
                       required>
            </div>
            <div class="form-group">
                <label for="userPasswordProfileNew">New password</label>
                <input type="password" class="form-control" id="userPasswordProfileNew" name="userPasswordProfileNew" 
                       required>
            </div>
            <div class="form-group">
                <label for="userPasswordProfileNewVerify">Retype new password</label>
                <input type="password" class="form-control" id="userPasswordProfileNewVerify" 
                       name="userPasswordProfileNewVerify" required>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>

