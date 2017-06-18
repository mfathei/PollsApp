pollsApp.factory('pollService', function ($http, $q) {
        return {
            getData: function (route, param) {
                var defer = $q.defer();
                $http.get(API_URL + route + '/' + param).then(function success(data) {
                        defer.resolve(data);
                    }
                    ,
                    function error() {
                        defer.reject('An error has occurred :(');
                    }
                );

                return defer.promise;
            },
            postData: function (id, data) {
                var defer = $q.defer();
                data = $.param(data);
                $http.post(API_URL + 'poll/' + id + '/option', data,
                    {
                        'headers': {
                            'Content-Type': 'application/x-www-form-urlencoded,charset=UTF-8'
                        }
                    }).then(function success(data) {
                        defer.resolve(data);
                    },
                    function error() {
                        defer.reject('Cannot post data to the server :(');
                    }
                );

                return defer.promise;
            }
        };
    }
);