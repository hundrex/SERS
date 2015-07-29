<?php require_once './model/DAL/UserDAL.php'; ?>

<div class="row filter-bar">
    <div class="col-lg-6">
        <div class="input-group">
            <select class="form-control">
                <option value="All">All</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
            <span class="input-group-addon" id="sizing-addon1">Items per page</span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
        </div>
    </div>
</div>

<?php $users = UserDAL::findAll(); ?>

<div class="panel panel-default">
    <div class="panel-heading">User list</div>
    <table class="table">
        <tr><th>Last Name</th><th>First Name</th><th>Birth date</th><th>User Type</th><th></th></tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->getNom(); ?></td>
                <td><?php echo $user->getPrenom(); ?></td>
                <td><?php echo $user->getDateNaissance(); ?></td>
                <td><?php echo $user->getType()->getLabel(); ?></td>
                <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" 
                            data-target=<?php echo '"#modalViewUserList-' . $user->getId() . '"' ?>>
                        <span class="glyphicon glyphicon-eye-open"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<nav class="center">
    <ul class="pagination" >
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>

<!--modal-->

<?php foreach ($users as $user): ?>
    <div class="modal fade" id=<?php echo '"modalViewUserList-' . $user->getId() . '"' ?> 
         tabindex="-1" role="dialog" 
         aria-labelledby=<?php echo '"modalViewUserList-' . $user->getId() . '"' ?> >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalViewUserList">
                        <?php
                        echo $user->getNom();
                        echo ' ';
                        echo $user->getPrenom();
                        ?>
                    </h4>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled">
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Pseudo: </dt>
                                <dd><?php echo $user->getPseudo(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Email: </dt>
                                <dd><?php echo $user->getMail(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Address: </dt>
                                <dd><?php echo $user->getAdresse(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Birth date: </dt>
                                <dd><?php echo $user->getDateNaissance(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Creation date: </dt>
                                <dd><?php echo $user->getDateCreation(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>User type: </dt>
                                <dd><?php echo $user->getType()->getLabel(); ?></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Module(s) followed: </dt>
                                <dd></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Module(s) teached: </dt>
                                <dd></dd>
                            </dl>
                        </li>
                        <li>
                            <dl class="dl-horizontal">
                                <dt>Avatar: </dt>
                                <dd><img src=<?php
                                    echo '".' . $user->getAvatar()->getType()->getChemin() .
                                    '/' . $user->getAvatar()->getNom() . '"';
                                    ?> ></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Edit</button>
                </div>
            </div>
        </div>
    </div>
    <?php
endforeach;
