var app = angular.module("app", ["ngRoute", "restangular"]);

app.config(function(RestangularProvider) {
    RestangularProvider.setBaseUrl("api");
    RestangularProvider.setFullResponse(true);
});