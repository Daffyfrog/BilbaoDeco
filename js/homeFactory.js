bilbaoDecoApp.factory('homeFactory', ['$http', '$q', function ($http, $q){
    var factory = {
        fetchArticles: function () {
            var deferred = $q.defer();
            $http.post('php/db.php?action=getArticles', {}).then(function success(data, status, headers, config) {
                deferred.resolve(data.data);
            }, function error(data, status, headers, config) {
                deferred.reject("Could not get Articles");
            });
            return deferred.promise;
        },
    };
    return factory;
}]);