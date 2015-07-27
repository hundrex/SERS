<form method=POST action="./controller/page/user_create.php">
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
               placeholder="e.g. For 13th september 1971 : 1971/09/13">
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
    <div class="form-group">
        <label for="userType">User type</label>
        <select class="combobox" id="userType" name="userType">
            <option value="1">Root</option>
            <option value="2">Administration</option>
            <option value="3">Teacher</option>
            <option value="4">Student</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

