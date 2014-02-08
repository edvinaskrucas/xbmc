var app = angular.module("app", ["ngRoute", "restangular"])

    .controller("Player", function($scope, Restangular) {

        $scope.player = null;

    });

app.config(function(RestangularProvider) {
    RestangularProvider.setBaseUrl("api");
    RestangularProvider.setFullResponse(true);
});