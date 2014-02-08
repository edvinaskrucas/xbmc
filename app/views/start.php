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
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" ng-show="player">
            <div class="container">
                <button type="button" class="btn btn-default navbar-btn" ng-click="play(player)"><i class="glyphicon" ng-class="{'glyphicon-play' : playerProperties.speed == 0, 'glyphicon-pause' : playerProperties.speed == 1}"></i></button>
            </div>
        </nav>
    </div>

    <div ng-view class="fill"></div>

    <script src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/underscore.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular-route.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/restangular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/app.js') ?>"></script>
</body>
</html>