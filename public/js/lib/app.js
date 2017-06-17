var modules = [
    'ngRoute',
    'angularCharts'
];
var pollsApp = angular.module('pollsApp', modules);

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
