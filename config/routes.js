bilbaoDecoApp.config(['$stateProvider', '$urlRouterProvider', '$locationProvider' ,function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    $stateProvider
        .state('admin', {
            url: '/login',
            templateUrl: './templates/admin.html',
            controller: "loginController"
        })
        .state('create', {
          url: '/create',
          controller: 'createArticleController',
          templateUrl: "templates/create.html",
            params: {
                isLogged: false
            },
            resolve: {
                'isLogged': ['$stateParams', function ($stateParams) {
                    return $stateParams.isLogged;
                }]
            }
        })
        .state('edit')
        .state('accueil', {
            url: '/accueil',
            templateUrl: 'templates/home.html',
            controller: 'homeController',
            resolve: {
                'articlesList': ['articleFactory', function (articleFactory) {
                    return articleFactory.fetchArticles();
                }]
            }
        })
        .state('article', {
            url: '/article/{id:int}',
            templateUrl: 'templates/article.html',
            controller: 'articleController',
            resolve: {
                'article': ['articleFactory', '$stateParams', function (articleFactory, $stateParams) {
                    return articleFactory.getArticleById($stateParams.id);
                }]
            }
        });
    $urlRouterProvider.otherwise('/accueil');
}]);