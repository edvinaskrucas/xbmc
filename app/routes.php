<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

App::singleton('jsonrpc.client', function() {
    return new \Graze\Guzzle\JsonRpc\JsonRpcClient('http://xbmc:jasna@192.168.2.111:8080/jsonrpc');
});
