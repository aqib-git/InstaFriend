<?php
namespace AqibPandit\InstaFriend;

interface HttpClientInterface
{
    public function request($url, $method, array $headers =[], $param = null,array $data = []);
}