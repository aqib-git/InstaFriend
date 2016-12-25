<?php
namespace AqibPandit\InstaFriend;

use AqibPandit\InstaFriend\HttpClient;
use AqibPandit\InstaFriend\Instagram;

use Dotenv\Dotenv;
class Util {
    
    public static function loadEnv()
    {
        $dotenv = new Dotenv(dirname(__DIR__));
        try{
            $dotenv->load();
            $dotenv->required(['INSTA_CLIENT_ID', 'INSTA_CLIENT_SECRET', 'APP_URI']);
        } catch(\Exception $e) {
            die("<b>INSTA_CLIENT_ID</b>, <b>INSTA_CLIENT_SECRET</b> and <b>APP_URI</b> must be set in .env file");
        }
    }

    public static function getInstaClient()
    {
        define('INSTA_CLIENT_ID', getenv('INSTA_CLIENT_ID'));
        define('INSTA_CLIENT_SECRET', getenv('INSTA_CLIENT_SECRET'));
        define('APP_URI', getenv('APP_URI'));
        return new Instagram(new HttpClient(), INSTA_CLIENT_ID, INSTA_CLIENT_SECRET, APP_URI);
    }
}