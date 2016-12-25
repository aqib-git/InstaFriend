<?php
session_start();
require_once('./vendor/autoload.php');

/* load current environment configuration*/
AqibPandit\InstaFriend\Util::loadEnv();

/* load instagram client */
$instagram = AqibPandit\InstaFriend\Util::getInstaClient();

/* check if authorization is cancelled */
if(isset($_GET['error'])) {
    header('location:'.$instagram->getAppUri().'?show_authorization_cancelled_msg=true');
    die();
}

if(isset($_GET['code'])) {
    $code = $_GET['code'];
    if(($token=$instagram->getToken($code)) !== false){
        $tokenArray = json_decode($token, true);
        $_SESSION['access_token'] = $tokenArray['access_token'];
        $_SESSION['current_user'] = $tokenArray['user'];
        header('location:'.$instagram->getAppUri());
    } else {
        unset($_SESSION['access_token']);
        unset($_SESSION['current_user']);
    }
}