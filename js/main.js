var $ENDPOINT = "http://localhost:8080/tdc/";

var app = angular.module('AngularApp', ['ngResource','ngRoute','ngMessages']);

app.config(function($routeProvider, $locationProvider, $httpProvider) {

   $httpProvider.interceptors.push('httpInterceptor');
   $routeProvider

        .when('/'
          , { templateUrl : 'partials/home.html'
          , controller: 'homeCtrl'})

         .when('/home'
          , { templateUrl : 'partials/home.html'
          , controller: 'homeCtrl'})

         .when('/about'
          , { templateUrl : 'partials/about.html'
          , controller: 'homeCtrl'})

         .when('/services'
          , { templateUrl : 'partials/services.html'
          , controller: 'homeCtrl'})

          .when('/contact'
          , { templateUrl : 'partials/contact.html'
          , controller: 'contactCtrl'})

        .otherwise({ redirectTo: '/' });
});
