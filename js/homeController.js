bilbaoDecoApp.controller('homeController',['$scope', '$http', '$rootScope', 'articlesList', function ($scope, $http, $rootScope, articlesList) {
    console.log(articlesList);
    $scope.articles = articlesList;

}]);