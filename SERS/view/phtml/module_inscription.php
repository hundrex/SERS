<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php'); ?>
<script type="text/javascript" src="./view/javascript/module_inscription.js"></script>
<form method=POST action="./controller/page/module_inscription.php">
    <div class="row filter-bar">
        <div class="col-lg-12">
            <div class="input-group">
                <?php $modules = ModuleDAL::findAll(); ?>   
                <label for="descriptionModule">Select a module</label>
                <select class="form-control" id="module-inscription-selecter">
                    <?php foreach ($modules as $module): ?>
                        <option value="<?php echo $module->getId(); ?>" id="<?php echo $module->getId(); ?>">
                            <?php echo $module->getLabel(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <?php $students = UserDAL::findAllStudent(); ?>

    <div id="panel-students-module" class="panel panel-default hidden">
        <div class="panel-heading">Student list</div>
        <div class="panel-list">
            <ul class="list-unstyled">
                <?php foreach ($students as $student): ?>
                    <li><div class="checkbox">
                            <label>
                                <input type="checkbox" name="student[]" 
                                       id="checkbox-eleve-<?php echo $student->getId(); ?>"> <?php echo $student->getPrenom() . " " . $student->getNom(); ?>
                            </label>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

