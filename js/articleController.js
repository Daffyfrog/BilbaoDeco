bilbaoDecoApp.controller('articleController',['$scope', '$http', '$rootScope', 'article', '$sce', function ($scope, $http, $rootScope, article, $sce) {
    console.log(article);
    $scope.article = article;
    $scope.article.text = $sce.trustAsHtml($scope.article.text);
    $scope.article.date = new Date($scope.article.date);
}]);