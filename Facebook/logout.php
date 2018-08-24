<?php
require_once 'config.php';
unset($_SESSION['fb_access_token']);
header('Location:index.php');
?>