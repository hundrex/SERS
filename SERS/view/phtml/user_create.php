<form method="POST" action="/controller/page/user_create.php">
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input type="text" class="form-control" id="lastName" placeholder="e.g. Anderson">
    </div>
    <div class="form-group">
        <label for="firstName">First name</label>
        <input type="text" class="form-control" id="firstName" placeholder="e.g. Thomas">
    </div>
    <div class="form-group">
        <label for="birthDate">Birth date</label>
        <input type="date" class="form-control" id="birthDate" 
               placeholder="e.g. For 13th september 1971 : 13-09-1971">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" 
               placeholder="e.g. 21 St Nicholas St Bristol BS1 1UA">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" 
               placeholder="e.g. thomas.anderson@skynet.com">
    </div>
    <div class="form-group">
        <label for="userType">User type</label>
        <select class="combobox">
            <option value="Root">Root</option>
            <option value="Administration">Administration</option>
            <option value="Teacher">Teacher</option>
            <option value="Student">Student</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

