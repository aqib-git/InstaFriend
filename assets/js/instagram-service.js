'use strict';

angular.module('InstaFriend')
.factory('InstaService',['$http', function($http){
    var _getFollowerImages = function() {
        console.log("HELLO FRIEND")
    }

    var _getAuthorizedUser = function() {
        return httpService('authorized_user', '');
    }

    var _getInstagramAuthorizeUri = function() {
        return httpService('instagram_authorize_uri');
    }

    function httpService(command, optionsObject = {}) {
        var data = "";
        if(command) {
            data = 'command='+encodeURIComponent(command);
        }
        data += '&options='+JSON.stringify(optionsObject);
        var req = {
             method: 'POST',
             url: '/',
             headers: {
               'Content-Type': 'application/x-www-form-urlencoded'
             },
             data: data
        }
        return $http(req);
    }

    var service = {};
    service.getInstagramAuthorizeUri = _getInstagramAuthorizeUri;
    service.getAuthorizedUser = _getAuthorizedUser;

    return service;
}]);