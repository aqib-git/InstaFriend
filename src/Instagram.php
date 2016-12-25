<?php
namespace AqibPandit\InstaFriend;

use AqibPandit\InstaFriend\InstagramInterface;
use AqibPandit\InstaFriend\HttpClientInterface;

class Instagram implements InstagramInterface
{
    private $_clientId;
    private $_clientSecret;
    private $_appUri;
    private $_httpClient;

    public function __construct(HttpClientInterface $httpClient, $clientId, $clientSecret, $appUri)
    {
        $this->_httpClient = $httpClient;
        $this->_clientId = $clientId;
        $this->_clientSecret = $clientSecret;
        $this->_appUri = $appUri;
    }

    public function getAuthorizedUser()
    {
        if(isset($_SESSION['access_token']) && isset($_SESSION['current_user'])) {
            die(json_encode(array('currentUser' => $_SESSION['current_user'])));
        }
    }
    
    public function getInstagramAuthorizeUri()
    {
        return 'https://api.instagram.com/oauth/authorize/?client_id='.$this->_clientId.'&redirect_uri='.$this->_appUri.'/authorize.php&response_type=code';
    }

    public function getToken($code) {
        $url = "https://api.instagram.com/oauth/access_token";
        $method = "post";
        $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
        $data = array(
            'client_id' => $this->_clientId,
            'client_secret' => $this->_clientSecret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->_appUri.'/authorize.php',
            'code' => $code
        );
        try {
            $response = $this->_httpClient->request($url, $method, $headers, null, $data)->getBody();
        } catch(\Exception $e) {
            unset($_SESSION['access_token']);
            unset($_SESSION['current_user']);
            header('location:'.$this->_appUri.'?access_token_error=true');
        }
        return $response->getContents();
    }

    public function getAppUri()
    {
        return $this->_appUri;
    }
}