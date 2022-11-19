<?php
require_once('core/controller.Class.php');
if(isset($_COOKIE['id']) && isset($_COOKIE['sess'])){
    $Controller = new Controller;
    if(!($Controller -> checkUserStatus($_COOKIE['id'], $_COOKIE['sess']))){
        header("Location: login.php");
    }
    
}else{ 
    if(!isset($_SESSION["user"]) )    
header("Location: login.php");
}