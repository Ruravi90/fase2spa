
function geturl(){
    return window.location.origin+'/';
}

var app = angular.module('App', ['ui.bootstrap','cp.ngConfirm','ui-notification', 'ui.bootstrap.datetimepicker','scania.angular.select2','ngSanitize', 'ui.select'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.config(function($httpProvider,NotificationProvider,$qProvider) {
    NotificationProvider.setOptions({
        delay: 9000,
        startTop: 20,
        startRight: 10,
        verticalSpacing: 20,
        horizontalSpacing: 20,
        positionX: 'right',
        positionY: 'bottom'
    });

    //$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    //$httpProvider.defaults.headers.post['Accept'] = 'application/x-www-form-urlencoded';
});

app.run(function($rootScope,$http, $templateCache) {
  
});

app.controller('MainController', function($rootScope,$scope, $http,Notification) {
    $rootScope.anySearch='';
});
