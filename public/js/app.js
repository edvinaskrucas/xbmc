var app = angular.module("app", ["ngRoute", "restangular"])

    .controller("Player", function($scope, Restangular, $timeout) {

        $scope.player = null;

        /**
         * Function load active audio player.
         */
        var loadAudioPlayer = function() {
            Restangular.all("Player/GetActivePlayers").getList().then(
                function(response) {
                    if (response.data.length > 0) {
                        if (response.data[0].type == "audio") {
                            $scope.player = response.data[0];
                        } else {
                            $scope.player = null;
                        }
                        $timeout(loadAudioPlayer, 1000);
                    }
                },
                function(response) {
                    $scope.player = null;
                    $timeout(loadAudioPlayer, 1000);
                }
            );
        }

        loadAudioPlayer();

    });

app.config(function(RestangularProvider) {
    RestangularProvider.setBaseUrl("api");
    RestangularProvider.setFullResponse(true);
});