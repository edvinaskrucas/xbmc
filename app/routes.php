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

Route::group(array('prefix' => 'api'), function() {
    Route::group(array('prefix' => 'audio'), function() {
        Route::get('artists/', function() {
            $start      = Input::get('start', 0);
            $end        = Input::get('end', 0);
            $sortMethod = Input::get('sortMethod', 'artist');
            $sortOrder  = Input::get('sortOrder', 'ascending');
            $filter     = Input::get('filter', '');

            $client = App::make('jsonrpc.client');
            $request = $client->request(
                'AudioLibrary.GetArtists',
                1,
                array(
                    'sort'          => array(
                        'order'         => $sortOrder,
                        'method'        => $sortMethod,
                        'ignorearticle' => true,
                    ),
                    'filter'        => array(
                        'field'         => 'artist',
                        'operator'      => 'contains',
                        'value'         => $filter,
                    ),
                    'properties'    => array('thumbnail', 'fanart'),
                    'limits'        => array(
                        'start'         => (int) $start,
                        'end'           => (int) $end,
                    )
                )
            );
            $response = $request->send();
            return $response->getResult();
        });
    });
});