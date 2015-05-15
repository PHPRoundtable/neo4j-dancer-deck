<?php

Route::get('/', 'HomeController@index');

Route::get('oauth2/facebook/login', 'Auth\OAuth2Controller@facebookAuthorize');
Route::get('oauth2/facebook/callback', 'Auth\OAuth2Controller@facebookCallback');

Route::controllers([
  'auth'     => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

$adminOpts = [
  'namespace' => 'Admin',
  'before' => 'auth',
  'prefix' => 'admin',
];
Route::group($adminOpts, function() {
    Route::get('/', ['as' => 'admin.home', 'uses' => 'EventController@index']);
    Route::get('event/import', 'EventController@import');
    Route::resource('event', 'EventController');
});
