bilbaoDecoApp.controller('loginController', function ($scope, $http, $rootScope) {
    $scope.vm = {
        login : "",
        password: ""
    };
    /** function to delete product from list of product referencing php **/


    $scope.loginAdmin = function () {
        $http.post('php/db.php?action=login',
            {
                'login': $scope.vm.login,
                'password': $scope.vm.password
            }
        ).then(function success(data, status, headers, config) {
            console.log(data.data);
            alert(data.data.login_ok);
            $rootScope.isLogged = true;
        }, function error(data, status, headers, config) {
            error("Err ?")
        });
    };



});