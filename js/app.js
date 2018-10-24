var bilbaoDecoApp = angular.module('bilbaoDecoApp', ['ngRoute', 'ui.router', 'ui.bootstrap', 'angular-carousel', 'ngFileUpload']);
bilbaoDecoApp.run(function ($rootScope) {
    var isLogged = false;
    $rootScope.isLogged = function(){
        if (!isLogged) isLogged = sessionStorage.getItem('isLogged');
        return isLogged;
    };
    $rootScope.setLogged = function (isLog) {
        sessionStorage.setItem('isLogged', isLog);
    }
});