<?php
unset($_COOKIE["user_id"]);
unset($_COOKIE["user_role"]);
session_start();
session_unset();
session_destroy();
header('Location: ../../');
exit();