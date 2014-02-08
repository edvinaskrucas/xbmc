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

    <div ng-view class="fill"></div>

    <script src="https://code.jquery.com/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/underscore.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/angular-route.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/restangular.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo URL::asset('js/app.js') ?>"></script>
</body>
</html>