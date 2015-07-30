<!DOCTYPE html>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/SERS/SERS/model/DAL/UserDAL.php');
session_start();
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
if ($pseudo !== null && $password !== null)
{
    $user = UserDAL::connection($pseudo, $password);
    if ($user)
    {
        $_SESSION['user'] = $user->getId();
        $_SESSION['role'] = $user->getRole();
        setcookie("user_id",$_SESSION['user']);
        setcookie("user_role",$_SESSION['role']);
    }
    else
    {
        $_SESSION['user'] = false;
    }
}
?>
<html>
    <head>
        <?php
        if (isset($_SESSION['user']))
        {
            $user = UserDAL::findById($_SESSION['user']);
        }
        ?>
        <meta charset="UTF-8">
        <title>SERS</title>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- Graph libraries -->
        <script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>

        <link rel="stylesheet" href="./view/css/main.css">

        <link rel="icon" type="image/png" href="./view/document/picture/favicon.png" />
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="?page=home">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span> SERS
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    if (isset($_SESSION['user']) &&
                            isset($_SESSION['role']) &&
                            $_SESSION['role'] === User::TYPE_USER_ROOT):
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">User <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=user_list">User List</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="?page=user_create">New...</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['user']) &&
                            isset($_SESSION['role']) &&
                            $_SESSION['role'] <= User::TYPE_USER_TEACHER):
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">Student <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=student_list">Student List</a></li>
                                    <?php
                                    if (isset($_SESSION['user']) &&
                                            isset($_SESSION['role']) &&
                                            $_SESSION['role'] <= User::TYPE_USER_ADMINISTRATION):
                                        ?>
                                        <li><a href="?page=module_inscription">Module Inscription</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="?page=student_create">New...</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['user']) &&
                            isset($_SESSION['role']) &&
                            $_SESSION['role'] <= User::TYPE_USER_STUDENT):
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">Module <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=module_list">All Modules</a></li>
                                    <li role="separator" class="divider"></li>
                                    <?php $modules = ModuleDAL::findAll(); ?>
                                    <?php
                                    foreach ($modules as $module)
                                    {
                                        echo '<li>'
                                        . '<a href="?page=module&module_id=' . $module->getId() . '">' .
                                        $module->getLabel() .
                                        '</a>'
                                        . '</li>';
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['user']) &&
                                            isset($_SESSION['role']) &&
                                            $_SESSION['role'] <= User::TYPE_USER_ADMINISTRATION):
                                        ?>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="?page=module_create">New...</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php
                    if ((isset($_SESSION['user']) &&
                            isset($_SESSION['role'])) &&
                            $_SESSION['role'] <= User::TYPE_USER_TEACHER):
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=report_a">A</a></li>
                                    <li><a href="?page=report_b">B</a></li>
                                    <li><a href="?page=report_c">C</a></li>
                                    <li><a href="?page=report_d">D</a></li>
                                    <li><a href="?page=report_e">E</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user'])): ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">
                                       <?php
                                       $user = UserDAL::findById($_SESSION['user']);
                                       echo '<img src=".' .
                                       $user->getAvatar()->getType()->getChemin() . '/' .
                                       $user->getAvatar()->getNom() .
                                       '" class="avatar"/>';
                                       echo $user->getPrenom() . ' ' . $user->getNom();
                                       ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=profile">Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" data-toggle="modal" data-target="#mail-mark">Resend Mark Mail</a></li>
                                    <li><a href="" data-toggle="modal" data-target="#mail-payment">Resend payment receipt</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="" data-toggle="modal" data-target="#log-out-modal">Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div id="left-column" class="col-lg-2"></div>
        <div id="content" class="col-lg-8">
            <?php
            $page_to_require = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_URL);
            if ($page_to_require !== null)
            {
                require_once './view/phtml/' . $page_to_require . '.php';
            }
            else
            {
                require_once './view/phtml/home.php';
            }
            ?>
        </div>
        <div id="right-column" class="col-lg-2"></div>

        <div class="modal fade" id="mail-mark" tabindex="-1" role="dialog" aria-labelledby="modalMail">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalMail">Confirm email resending</h4>
                    </div>
                    <div class="modal-body">
                        Do you confirm the resend request for your confirmation email?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mail-payment" tabindex="-1" role="dialog" aria-labelledby="modalPayment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalPayment">Confirm email resending</h4>
                    </div>
                    <div class="modal-body">
                        Do you confirm the resend request for your payment receipt email?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="log-out-modal" tabindex="-1" role="dialog" aria-labelledby="modalLogOut">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalLogOut">Log Out</h4>
                    </div>
                    <div class="modal-body">
                        Do you want to log out?
                    </div>
                    <div class="modal-footer">
                        <form action="./controller/page/logout.php">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-info">Log out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
    <footer>
        <div class="panel-footer navbar-fixed-bottom">
            <div> ©SERS 2015 </div>
        </div>
    </footer>
</html>