<!DOCTYPE html>
<html>
    <head>
        <?php
        session_start();
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
                            isset($_SESSION['role']) === User::TYPE_USER_ROOT):
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
                    if ((isset($_SESSION['user']) &&
                            isset($_SESSION['role'])) &&
                            (isset($_SESSION['role']) >= User::TYPE_USER_STUDENT)):
                        ?>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                                   aria-haspopup="true" aria-expanded="false">Student <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="?page=student_list">Student List</a></li>
                                    <li><a href="?page=module_inscription">Module Inscription</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="?page=student_create">New...</a></li>
                                </ul>
                            </li>
                        </ul>
<?php endif; ?>

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                               aria-haspopup="true" aria-expanded="false">Module <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=module_list">All Modules</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="?page=module">Web Development</a></li>
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">Content Management System</a></li>
                                <li><a href="#">Legal Ethical Social And Professional Issues</a></li>
                                <li><a href="#">Web Development Frameworks</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="?page=module_create">New...</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                               aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Overview</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="?page=report_a">A</a></li>
                                <li><a href="?page=report_b">B</a></li>
                                <li><a href="?page=report_c">C</a></li>
                                <li><a href="?page=report_d">D</a></li>
                                <li><a href="?page=report_e">E</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Print all</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                               aria-haspopup="true" aria-expanded="false">

                                <img src="./view/document/picture/smile.png" class="avatar"/> Jean-Michel CtrlCV 
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <form action="./controller/page/logout.php">
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