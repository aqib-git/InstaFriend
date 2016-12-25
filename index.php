<?php
session_start();
require_once('./vendor/autoload.php');

/* load current environment configuration*/
AqibPandit\InstaFriend\Util::loadEnv();


/* load user interface */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once('./ui.html');
    die();
}

/* load instagram client */
$instagram = AqibPandit\InstaFriend\Util::getInstaClient();

/* handle commands */
if(isset($_POST['command'])) {
    $command = $_POST['command'];
    switch ($command) {
        case 'authorized_user':
            echo $instagram->getAuthorizedUser() ? 'true' : 'false';
            break;
        case 'instagram_authorize_uri':
            echo $instagram->getInstagramAuthorizeUri();
            break;
    }
}
