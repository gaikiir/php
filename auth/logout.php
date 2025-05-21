<?php
session_start();
include './connectdb.php';
session_destroy();
header("Location: login.php");
?>