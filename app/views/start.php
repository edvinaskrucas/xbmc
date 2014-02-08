<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('css/bootstrap.min.css') ?>">
    <script type="text/javascript">
        var host = "<?php echo URL::to('/'); ?>";
    </script>
</head>
<body id="app">

    <div ng-controller="Player">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" ng-show="player">
            <div class="container">
                <div class="pull-left">
                    <button type="button" class="btn btn-default navbar-btn" ng-click="move(player, 'left')"><i class="glyphicon glyphicon-fast-backward"></i></button>
                    <button type="button" class="btn btn-default navbar-btn" ng-click="play(player)"><i class="glyphicon" ng-class="{'glyphicon-play' : playerProperties.speed == 0, 'glyphicon-pause' : playerProperties.speed == 1}"></i></button>
                    <button type="button" class="btn btn-default navbar-btn" ng-click="move(player, 'right')"><i class="glyphicon glyphicon-fast-forward"></i></button>
                    <button type="button" class="btn btn-default navbar-btn" ng-click="stop(player)"><i class="glyphicon glyphicon-stop"></i></button>
                </div>
                <p class="navbar-text">
                    <small><span ng-show="playerProperties.totaltime.minutes < 10">0</span>{{ playerProperties.totaltime.minutes }}:<span ng-show="playerProperties.totaltime.seconds < 10">0</span>{{ playerProperties.totaltime.seconds }} / <span ng-show="playerProperties.time.minutes < 10">0</span>{{ playerProperties.time.minutes }}:<span ng-show="playerProperties.time.seconds < 10">0</span>{{ playerProperties.time.seconds }}</small>
                    <strong>{{ itemInfo.label }}</strong> - <span ng-repeat="artist in itemInfo.artist">{{ artist }}</span>
                </p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ playerProperties.percentage }}%;"></div>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div ng-view></div>
            </div>
            <div class="col-lg-4">
                <div ng-controller="Playlist">
                    <div class="panel panel-default">
                        <div class="panel-heading">Playlist</div>
                        <div class="panel-body" ng-hide="items.length > 0">
                            <p>Empty...</p>
                        </div>
                        <div class="list-group" ng-show="items.length > 0">
                            <a ng-repeat="item in items" href="" class="list-group-item small"><strong>{{ item.title }}</strong> - <span ng-repeat="artist in item.artist">{{ artist }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/underscore.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular-route.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/restangular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/app.js') ?>"></script>
</body>
</html>