bilbaoDecoApp.factory('articleFactory', ['$http', '$q', 'Upload', function ($http, $q, Upload) {
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
        getArticleById: function (article_id) {
            var deferred = $q.defer();
            $http.post('php/db.php?action=getArticleById', {'article_id': article_id}).then(function success(data, status, headers, config) {
                deferred.resolve(data.data);
            }, function error(data, status, headers, config) {
                deferred.reject("Could not get Article");
            });
            return deferred.promise;
        },
        insertArticle: function (file, name, id) {
            var uploadUrl = "../php/save_form.php"
            var fd = new FormData();
            fd.append('file', file);
            fd.append('name', name);
            fd.append('id', id);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined, 'Process-Data': false}
            }).then(function () {
                console.log("Success");
            }, function () {
                console.log("err");
            });
        }
    };
    return factory;
}]);