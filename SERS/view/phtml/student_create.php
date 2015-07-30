<?php if ((isset($_SESSION['user']) && isset($_SESSION['role'])) && $_SESSION['role'] > User::TYPE_USER_ADMINISTRATION): ?>
    <META HTTP-EQUIV="Refresh" Content="0; URL=./?error=403">
<?php else: ?>

<?php require_once './model/DAL/ModuleDAL.php'; ?>

<form method=POST action="./controller/page/student_create.php">
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="e.g. Anderson">
    </div>
    <div class="form-group">
        <label for="firstName">First name</label>
        <input type="text" class="form-control" id="firstName" name="firstName" required placeholder="e.g. Thomas">
    </div>
    <div class="form-group">
        <label for="birthDate">Birth date</label>
        <input type="date" class="form-control" id="birthDate" name="birthDate" required 
               placeholder="e.g. For 13th september 1971 : 13/09/1971">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" required 
               placeholder="e.g. 21 St Nicholas St Bristol BS1 1UA">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required 
               placeholder="e.g. thomas.anderson@skynet.com">
    </div>

    <?php $modules = ModuleDAL::findAll(); ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">Modules</div>
        <div class="panel-list">
            <?php foreach ($modules as $module): ?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="<?php echo $module->getId();?>" name="module[]"> <?php echo $module->getLabel();?>
                </label>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<?php endif;?>
