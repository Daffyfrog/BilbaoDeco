bilbaoDecoApp.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function ($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    $stateProvider.state('admin', {
        url: '/login',
        templateUrl: './templates/admin.html',
        controller: "loginController"
    })
        .state('accueil', {
            url: '/accueil',
            templateUrl: 'templates/home.html',
            controller: 'homeController',
            resolve: {
                'articlesList': ['homeFactory', function (homeFactory) {
                    return homeFactory.fetchArticles();
                }]
            }
        });
    $urlRouterProvider.otherwise('/accueil');
}]);