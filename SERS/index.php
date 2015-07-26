<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>SERS</title>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <!-- Required for date picker -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
        <!--https://eonasdan.github.io/bootstrap-datetimepicker/Installing/-->
        

        <link rel="stylesheet" href="./view/css/main.css">
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

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                               aria-haspopup="true" aria-expanded="false">Student <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=student_list">Student List</a></li>
                                <li><a href="#">Module Inscription</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="?page=student_create">New...</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
                               aria-haspopup="true" aria-expanded="false">Module <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="?page=module_list">All Modules</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Web Development</a></li>
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">Content Management System</a></li>
                                <li><a href="#">Legal Ethical Social And Professional Issues</a></li>
                                <li><a href="#">Web Development Frameworks</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">New...</a></li>
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
                                <li><a href="#">A</a></li>
                                <li><a href="#">B</a></li>
                                <li><a href="#">C</a></li>
                                <li><a href="#">D</a></li>
                                <li><a href="#">E</a></li>
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
                                <li><a href="#">Profile Edition</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Resend Mark Mail</a></li>
                                <li><a href="#">Resend payment receipt</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Log Out</a></li>
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
            if ($page_to_require !== null) {
                require_once './view/phtml/' . $page_to_require . '.php';
            } else {
                require_once './view/phtml/home.php';
            }
            ?>
        </div>
        <div id="right-column" class="col-lg-2"></div>
    </body>
    <footer>
        <div class="panel-footer navbar-fixed-bottom">
            <div> ©SERS 2015 </div>
        </div>
    </footer>
</html>