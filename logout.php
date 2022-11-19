<?php

session_start();
session_unset();
setcookie('id', '', time() - 60*60*24*30, '/'); 
setcookie('sess', '', time() - 60*60*24*30, '/');

if (!isset($_SESSION['user'])) header("Location: index.php");