<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("389913104780-domll6etbjqddu2cn9nts1kj6li4qlkp.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("rentcam");
$gClient->setRedirectUri("http://localhost/pemweb/proyekakhir/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();
?>