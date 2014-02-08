var app = angular.module("app", ["ngRoute", "restangular"])

    .config(["$routeProvider", function($routeProvider) {
        $routeProvider
            .when(
                "/audio/artists",
                {
                    templateUrl     : "tpl/audio/artists.html",
                    controller      : "Audio.Artists"
                }
            )
            .otherwise(
            {
                redirectTo      : "/"
            }
        );
    }])

    .controller("Player", function($scope, Restangular, $timeout) {

        $scope.player = null;

        $scope.playerProperties = null;

        $scope.itemInfo = null;

        /**
         * Play of pause player.
         *
         * @param player
         */
        $scope.play = function(player) {
            Restangular.all("Player/PlayPause").post({ playerid : player.playerid }).then(
                function(response) {
                    $scope.playerProperties.speed = response.data.speed;
                }
            );
        };

        /**
         * Move player direction (fast forward, fast backward).
         *
         * @param player
         * @param direction
         */
        $scope.move = function(player, direction) {
            Restangular.all("Player/Move").post({ playerid : player.playerid, direction : direction });
        };

        /**
         * Stop player.
         *
         * @param player
         * @param direction
         */
        $scope.stop = function(player) {
            Restangular.all("Player/Stop").post({ playerid : player.playerid });
        };

        /**
         * Function load active audio player.
         */
        var loadAudioPlayer = function() {
            Restangular.all("Player/GetActivePlayers").getList().then(
                function(response) {
                    if (response.data.length > 0) {
                        if (response.data[0].type == "audio") {
                            $scope.player = response.data[0];
                            loadPlayerProperties($scope.player);
                            loadItemInfo($scope.player);
                        } else {
                            $scope.player = null;
                            $scope.playerProperties = null;
                            $scope.itemInfo = null;
                        }
                    } else {
                        $scope.player = null;
                        $scope.playerProperties = null;
                        $scope.itemInfo = null;
                    }
                    $timeout(loadAudioPlayer, 1000);
                },
                function(response) {
                    $scope.player = null;
                    $scope.playerProperties = null;
                    $scope.itemInfo = null;
                    $timeout(loadAudioPlayer, 1000);
                }
            );
        }

        /**
         * Loads properties for a given player.
         *
         * @param player
         */
        var loadPlayerProperties = function(player) {
            Restangular.one("Player/GetProperties").get({ playerid : player.playerid }).then(
                function(response) {
                    $scope.playerProperties = response.data;
                },
                function(response) {
                    $scope.playerProperties = null;
                }
            );
        };

        /**
         * Loads info of active item in player.
         *
         * @param player
         */
        var loadItemInfo = function(player) {
            Restangular.one("Player/GetItem").get({ playerid : player.playerid }).then(
                function(response) {
                    $scope.itemInfo = response.data.item;
                },
                function(response) {
                    $scope.itemInfo = null;
                }
            );
        };

        loadAudioPlayer();

    })

    .controller("Playlist", function($scope, Restangular, $timeout) {

        $scope.playlist = null;

        $scope.items = null;

        /**
         * Load active audio playlist.
         */
        var loadPlaylist = function() {
            Restangular.all("Playlist/GetPlaylists").getList().then(
                function(response) {
                    if (response.data.length > 0) {
                        if (response.data[0].type == "audio") {
                            $scope.playlist = response.data[0];
                            loadItems($scope.playlist);
                        } else {
                            $scope.playlist = null;
                            $scope.items = null;
                        }
                    } else {
                        $scope.playlist = null;
                        $scope.items = null;
                    }
                    $timeout(loadPlaylist, 1000);
                },
                function(response) {
                    $scope.playlist = null;
                    $scope.items = null;
                    $timeout(loadPlaylist, 1000);
                }
            );
        };

        /**
         * Load given playlist items.
         *
         * @param playlist
         */
        var loadItems = function(playlist) {
            Restangular.one("Playlist/GetItems").get({ playlistid : playlist.playlistid }).then(
                function(response) {
                    $scope.items = response.data.items;
                },
                function(response) {
                    $scope.items = null;
                }
            );
        };

        loadPlaylist();

    })

    .controller("Audio.Artists", function($scope, Restangular) {

        $scope.start = 0;

        $scope.end = 20;

        $scope.artists = [];

        /**
         * Loads artists.
         *
         * @param start
         * @param end
         */
        $scope.load = function(start, end) {
            Restangular.one("Audio/Artists").get({ start : start, end : end }).then(
                function(response) {
                    for (var i = 0; i < response.data.artists.length; i++) {
                        $scope.artists.push(response.data.artists[i]);
                    }
                }
            );
        };

        /**
         * Play selected artist.
         *
         * @param artist
         */
        $scope.play = function(artist) {
            Restangular.all("Player/Open").post({ item : artist.artistid, type : "artist" });
        };

        $scope.load($scope.start, $scope.end);

    })

    ;

app.config(function(RestangularProvider) {
    RestangularProvider.setBaseUrl("api");
    RestangularProvider.setFullResponse(true);
});