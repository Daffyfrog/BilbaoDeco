bilbaoDecoApp.controller('createArticleController', function ($scope, $http, articleFactory, $stateParams, $state, $rootScope) {
    if(!$rootScope.isLogged()){
        $state.go("admin");
    }
    $scope.article = {};
    $scope.article.auteur = "Violaine POMARET";

    $scope.save = function (img) {
        console.log(img);
        $scope.img = img;
        $http.post('php/db.php?action=insertArticle',
            {
                'title': $scope.article.title,
                'text': $scope.article.text,
                'author': $scope.article.auteur,
                'file_name': img.name,
            }
        ).then(function success(data, status, headers, config) {
            console.log(data.data);
            $scope.saveFile(data.data.id)
        }, function error(data, status, headers, config) {
            error("Err ?")
        });
    };
    $scope.uploadFile = function () {
        $scope.article.img = event.target.files[0].name;
    };
    $scope.saveFile = function(id) {
        var file = $scope.img;

        var name = $scope.img.name;
        articleFactory.insertArticle(file, name, id);
    }
});