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

    <div class="panel panel-default">
        <div class="panel-heading">Modules</div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="module[]"> Web Development
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="2" name="module[]"> Web Design
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="3" name="module[]"> Content Management System
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="4" name="module[]"> Legal Ethical Social and Professional Issues
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="5" name="module[]"> Web Development Framework
            </label>
        </div>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>

