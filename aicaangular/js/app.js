/***
*Created by Samuel Antwi 2/10/2018
*Url https://storehubs.com
***/
'use strict'
var app = angular.module("ngwp", ['ngRoute']);

app.config(['$routeProvider', function($routeProvider){
     $routeProvider
      .when('/',{templateUrl: '/wp-content/plugins/aicaangular/aicalaravel/public',controller:'StartCtrl' })
      .when('/start',{templateUrl: '/wp-content/plugins/aicaangular/partials/start.php',controller:'StartCtrl' })
      .otherwise({redirectTo: '/' });
}]);