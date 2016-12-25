'use strict';

angular.module('InstaFriend')
.controller('InstaCtrl',['$scope', 'InstaService', function($scope, InstaService){
    $scope.instagram = {};
    $scope.instagram.authorizationCancelled = false;
    $scope.instagram.accessTokenError = false;
    $scope.instagram.showAuthorizeButton = true;

    $scope.currentUser = {};

    if(getParameterByName('show_authorization_cancelled_msg') 
        && getParameterByName('show_authorization_cancelled_msg') === 'true') {
        $scope.instagram.authorizationCancelled = true;
    }

    if(getParameterByName('access_token_error') 
        && getParameterByName('access_token_error') === 'true') {
        $scope.instagram.accessTokenError = true;
    }

    /* check user is authorized to instagram */
    InstaService.getAuthorizedUser().then(
        function(response) {
            console.log(response.data);
            if(response.data.currentUser) {
                $scope.currentUser = response.data.currentUser;
                $scope.instagram.showAuthorizeButton = false;
            } else {
                $scope.instagram.showAuthorizeButton = true;
            }
        }
    );

    /*get Redirect Uri*/
    InstaService.getInstagramAuthorizeUri().then(
        function(response) {
            if(response.data) {
                $scope.instagram.redirectUri = response.data;
            }
        }
    );

    function getParameterByName(name, url) {
        if (!url) {
          url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}]);