var modules = [
    'ngRoute',
    'angularCharts'
];

var API_URL = 'http://pollappsvc.dev:8080/api/';

var pollsApp = angular.module('pollsApp', modules);

pollsApp.config(function($interpolateProvider, $locationProvider){
    // $interpolateProvider.startSymbol('{[{');
    // $interpolateProvider.endSymbol('}]}');
    $locationProvider.hashPrefix('');
    $locationProvider.html5Mode(true);
});

function pollsAppRouteConfig($routeProvider) {

    $routeProvider.when('/', {
        controller: 'IndexController',
        templateUrl: 'partials/list.html'
    }).when('/view/:id', {
        controller: 'PollController',
        templateUrl: 'partials/poll.html'
    }).when('/view/:id/stats', {
        controller: 'StatsController',
        templateUrl: 'partials/stats.html'
    });

    $routeProvider.otherwise({
        redirectTo: '/'
    });

}

pollsApp.config(pollsAppRouteConfig);
