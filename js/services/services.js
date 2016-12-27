angular.module('AngularApp')

    .factory('httpInterceptor', function httpInterceptor ($q, $window, $location) {
        console.info("#httpInterceptor");
        return function (promise) {
          var success = function (response) {
            return response;
          };
          var error = function (response) {
            if (response.status === 401) {
              $location.url('/');
            }
            return $q.reject(response);
          };
          return promise.then(success, error);
        };
    })

    .factory('AngularServices', ['$resource', function ($resource) {
        return $resource($ENDPOINT + 'product/:params', {}, {
            update: {
                method: "PUT"
            }
        });
    }])

  .factory('XptoServices', ['$http', function($http){

        var XptoServices = {};
        var config = { headers : { 'Content-Type': 'application/json' }};
        var url = $ENDPOINT + '/something';
        var bar = '/';

        XptoServices.searchXpto = function (param) {
            var call = url.concat('/action/')
                          .concat(param.ano).concat(bar)
                          .concat(param.mes);
            return $http.post(call,candidato,config);
        };
}]);
