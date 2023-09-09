<?php
session_start();
$_SESSION['user_role'] = '';
header("LOCATION: ../dashboard/login.php");