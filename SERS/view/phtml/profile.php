<div class="panel panel-default">
    <div class="panel-heading">Personnal information</div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <li>
                    <dl class="dl-horizontal">
                        <dt>Pseudo: </dt>
                        <dd>thomas.anderson</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Last name: </dt>
                        <dd>Anderson</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>First name: </dt>
                        <dd>Thomas</dd>
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
                        <dd>13/09/1971</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Address: </dt>
                        <dd>21 St Nicholas St Bristol BS1 1UA</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Email: </dt>
                        <dd>thomas.anderson@skynet.com</dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--Differ is student or teacher-->
<div class="panel panel-default">
    <div class="panel-heading">Followed modules</div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <li>
                    <dl class="dl-horizontal">
                        <dt>Module 1: </dt>
                        <dd>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                            Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Module 2: </dt>
                        <dd>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                            Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</dd>
                    </dl>
                </li>
                <li>
                    <dl class="dl-horizontal">
                        <dt>Module 3: </dt>
                        <dd>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                            Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Student list for each teached module</div>
    <div class="panel-body">
        <div class="panel-list">
            <ul class="list-unstyled">
                <li>
                    <div class="panel panel-default">
                        <div class="panel-heading">Web Development</div>
                        <div class="panel-body">
                            <div class="panel-list">
                                <ul class="list-unstyled">
                                    <li>
                                        Anderson Thomas
                                    </li>
                                    <li>
                                        Rabbit Roger
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="panel panel-default">
                        <div class="panel-heading">Web Development Framework</div>
                        <div class="panel-body">
                            <div class="panel-list">
                                <ul class="list-unstyled">
                                    <li>
                                        Anderson Thomas
                                    </li>
                                    <li>
                                        Rabbit Roger
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>


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

