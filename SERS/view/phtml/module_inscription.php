<form method=POST action="./controller/page/student_create.php">
    <div class="row filter-bar">
        <div class="col-lg-12">
            <div class="input-group">
                <label for="descriptionModule">Select a module</label>
                <select class="form-control">
                    <option value="webDevelopment">Web Development</option>
                    <option value="webDesign">Web Design</option>
                    <option value="contentManagementSystem">Content Management System</option>
                    <option value="legalEthicalSocialAndProfessionalIssues">Legal Ethical Social and Professional Issues</option>
                    <option value="webDevelopmentFramework">Web Development Framework</option>
                </select>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Student list</div>
        <div class="panel-list">
            <ul class="list-unstyled">
                <li><div class="checkbox">
                        <label>
                            <input type="checkbox"> Student A
                        </label>
                    </div>
                </li>
                <li><div class="checkbox">
                        <label>
                            <input type="checkbox"> Student B
                        </label>
                    </div>
                </li>
            </ul>
        </div>

    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

