<div class="row">
    <div class="col-lg-6">
        <div class="input-group">
            <label for="title">Web Development</label>
            <p>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</p>
        </div>
    </div>
    <div class="col-lg-6">
        <?php if ($_GET['role'] == 'teacher'): ?>
            <div class="input-group input-right">
                <button type="button" class="btn btn-danger  btn-right">
                    <span class="glyphicon glyphicon-trash"></span></button>
                <button type="button" class="btn btn-primary btn-right">
                    <span class="glyphicon glyphicon-pencil"></span></button>
            </div>
        <?php elseif ($_GET['role'] == 'student'): ?>
            <div class="input-group">
                <label for="finalMark">Final mark :</label>
                <p>15</p>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="title pull-left">
                    Assignment 
                </div>
                <div class="option pull-right">
                    <?php if ($_GET['role'] == 'teacher'): ?>
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    <?php elseif ($_GET['role'] == 'student'): ?>
                        <span class="assignment-mark">Assignment mark: <span>14</span></span>
                    <?php endif ?>
                </div>
            </div>
            <div class="panel-body">
                <label for="assignmentTitle">SERS project</label>
                <!-- Date -->
                <p>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                    Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <div class="title pull-left">
                    Exam
                </div>
                <div class="option pull-right">
                    <?php if ($_GET['role'] == 'teacher'): ?>
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    <?php elseif ($_GET['role'] == 'student'): ?>
                        <span class="exam-mark">Exam mark: <span>14</span></span>
                    <?php endif ?>
                </div>
            </div>
            <div class="panel-body">
                <label for="assignmentTitle">SERS project</label>
                <!-- Date -->
                <p>Nam vestibulum at eros ac cursus. Sed sapien nisl, accumsan quis lacinia vel, tempor in libero. 
                    Sed dapibus velit eu velit iaculis, eu consectetur ante auctor.</p>
            </div>
        </div>
    </div>
</div>

<?php if ($_GET['role'] == 'teacher'): ?>
    <div class="panel panel-default">
        <div class="panel-heading">Student marks</div>
        <table class="table">
            <tr><th>Last Name</th><th>First Name</th><th>Assignment mark</th><th>Exam mark</th><th>Final mark</th></tr>
            <tr><td>Durden</td><td>Taylor</td><td>18</td><td>20</td><td>19</td></tr>
            <tr><td>Rabbit</td><td>Roger</td><td>8</td><td>10</td><td>9</td></tr>
        </table>
    </div>
    <div class="center">
        <nav>
            <button type="button" class="btn btn-default  btn-right">Import marks (.csv) <span 
                    class="glyphicon glyphicon-open-file"></span></button>
        </nav>
    </div>
    <?php

 endif ?>