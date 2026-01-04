<?php 

SESSION_START();
include 'db.php';

unset($_SESSION["username"]);
unset($_SESSION["u_id"]);
SESSION_DESTROY();
header("Location:login.php");

?>