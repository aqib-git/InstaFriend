<?php
namespace AqibPandit\InstaFriend;

interface InstagramInterface 
{
    public function getAuthorizedUser();
    public function getInstagramAuthorizeUri();
    public function getToken($code);
    public function getAppUri();
}