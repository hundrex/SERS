<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');?>
<form method=POST action="./controller/page>/module_inscription.php">
    <div class="row filter-bar">
        <div class="col-lg-12">
            <div class="input-group">
                
                <label for="descriptionModule">Select a module</label>
                <select class="form-control">
                    <option value="webDevelopment">Web Development</option>
                    <option value="webDesign">Web Design</option>
                    <option value="contentManagementSystem">Content Management System</option>
                    <option value="legalEthicalSocialAndProfessionalIssues">
                        Legal Ethical Social and Professional Issues</option>
                    <option value="webDevelopmentFramework">Web Development Framework</option>
                </select>
            </div>
        </div>
    </div>
    
    <?php $students = UserDAL::findAllStudent(); ?>
    
    <div class="panel panel-default">
        <div class="panel-heading">Student list</div>
        <div class="panel-list">
            <ul class="list-unstyled">
                <?php foreach ($students as $student): ?>
                <li><div class="checkbox">
                        <label>
                            <input type="checkbox" name="student[]" id="<?php echo $student->getId(); ?>"> <?php echo $student->getPrenom()." ".$student->getNom(); ?>
                        </label>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

