bilbaoDecoApp.controller('loginController', function ($scope, $http, $rootScope, $state) {
    $scope.vm = {
        login : "",
        password: ""
    };
    $scope.loginAdmin = function () {
        $http.post('php/db.php?action=login',
            {
                'login': $scope.vm.login,
                'password': $scope.vm.password
            }
        ).then(function success(data, status, headers, config) {
            console.log(data.data);
            alert(data.data.login_ok);
            if(!data.data.login_ok){
                alert("Identifiants incorrects");
            } else {
                $rootScope.setLogged('true');
                $state.go("create", {'isLogged': true})
            }
        }, function error(data, status, headers, config) {
            error("Err ?")
        });
    };



});