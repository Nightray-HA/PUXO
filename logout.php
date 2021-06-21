<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['foto']);
session_destroy();
header("location:index.php");
?>