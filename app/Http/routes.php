<?php

Route::get('/', 'HomeController@index');

Route::resource('event', 'EventController');

Route::get('oauth2/facebook/login', 'Auth\OAuth2Controller@facebookAuthorize');
Route::get('oauth2/facebook/callback', 'Auth\OAuth2Controller@facebookCallback');

Route::controllers([
  'auth'     => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);
