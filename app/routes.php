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


Route::get('login', array('as' => 'account.form', 'uses' => 'AuthenticationController@loginform'));
Route::post('login', array('as' => 'account.login', 'uses' => 'AuthenticationController@login'));
Route::get('home', array('as' => 'home', 'uses' => 'AuthenticationController@home'));
Route::get('/', array('uses' => 'AuthenticationController@home'));

Route::group(array('before' => 'auth'), function()
{
	Route::post('logout', array('as' => 'account.logout', 'uses' => 'AuthenticationController@logout'));
	Route::resource('releases.revisions', 'RevisionsController');
	Route::resource('approvals', 'ApprovalsController');
	Route::group(array('before' => 'auth.admin'), function()
	{
		Route::resource('users', 'UsersController');
		Route::resource('roles', 'RolesController');
	});
	Route::group(array('before' => 'auth.content.admin'), function()
	{
		Route::resource('releases', 'ReleasesController');
		Route::post('releases/{release_id}/publish', array('as' => 'releases.publish', 'uses' => 'ReleasesController@publish'));
	});
});

