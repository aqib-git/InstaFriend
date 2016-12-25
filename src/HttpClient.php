<?php
namespace AqibPandit\InstaFriend;

use AqibPandit\InstaFriend\HttpClientInterface;
use GuzzleHttp\Client;

class HttpClient implements HttpClientInterface
{
    private $_client;
    
    public function __construct()
    {
        $this->_client = new Client();
    }
    public function request($url, $method, array  $headers = [], $param = null, array $data = [])
    {
        if(empty($headers['User-Agent'])) {
            $headers['User-Agent'] = $this->getUserAgent();
        }
        if(empty($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
            $body = $data;   
        } else {
            $body = "";
        }

        if($headers['Content-Type'] === 'application/x-www-form-urlencoded') {
            $formParams = $data;
        } else {
            $formParams = "";
        }

        return $this->_client->request($method, $url, [
            'headers' => $headers,
            'query' => $param,
            'body' => $body,
            'form_params' => $formParams
        ]);
    }
    private function getUserAgent () {
        return 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36';
    }
}