<?php

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@createClient');
Route::get('/domain', 'IndexController@domain');
Route::post('/domain', 'IndexController@domainCreate');

