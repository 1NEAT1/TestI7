<?php

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@create');
Route::get('/dns', 'IndexController@dns');
Route::post('/dns', 'IndexController@update');
