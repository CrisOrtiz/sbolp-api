<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test', 'AuthController@test');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 100, 'expires' => 5],function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers',], function ($api) {
        $api->post('login', 'AuthController@login');
        $api->post('register', 'AuthController@register');   
       
    });

    $api->group(['prefix' => 'reset-password', 'namespace' => 'App\Http\Controllers'], function ($api) {
        $api->post('', 'UpdatePasswordController@resetPassword');         
        $api->post('/request', 'ResetPasswordRequestController@requestForgotPassword');   
        $api->post('/token', 'UpdatePasswordController@isValidToken');   
    });

    $api->group(['prefix' => 'images', 'namespace' => 'App\Http\Controllers'], function ($api) {      
        $api->post('', ['as' => 'api.images.upload', 'uses' => 'ImageController@store']);
        $api->post('{fileName}', ['as' => 'api.images.delete', 'uses' => 'ImageController@delete']);
        $api->get('{fileName}', ['as' => 'api.images', 'uses' => 'ImageController@getImageUrl']);
    });
});

$api->version('v1',['middleware' => 'auth:api', 'namespace' => 'App\Http\Controllers'], function ($api) {

    $api->group(['prefix' => 'case'], function ($api) {      
        $api->get('all', ['as' => 'api.case.index', 'uses' => 'ClinicCaseController@index']);
        $api->get('user-cases', ['as' => 'api.case-index.user', 'uses' => 'ClinicCaseController@indexUserCases']);
        $api->get('user-case', ['as' => 'api.case.user', 'uses' => 'ClinicCaseController@getCaseUser']);
        $api->get('show/{id}', ['as' => 'api.case.show', 'uses' => 'ClinicCaseController@show']);     
        $api->post('update', ['as' => 'api.case.update', 'uses' => 'ClinicCaseController@update']);   
        $api->post('create', ['as' => 'api.case.create', 'uses' => 'ClinicCaseController@store']);               
        $api->delete('{id}', ['as' => 'api.case.delete', 'uses' => 'ClinicCaseController@destroy']);
    });

    $api->group(['prefix' => 'comment'], function ($api) {      
        $api->get('all', ['as' => 'api.comment.index', 'uses' => 'CommentController@index']);
        $api->get('user-comments', ['as' => 'api.comment-index.user', 'uses' => 'CommentController@indexUserComments']);
        $api->get('show/{id}', ['as' => 'api.comment.show', 'uses' => 'CommentController@show']);     
        $api->post('update', ['as' => 'api.comment.update', 'uses' => 'CommentController@update']);   
        $api->post('create', ['as' => 'api.comment.create', 'uses' => 'CommentController@store']);               
        $api->delete('{id}', ['as' => 'api.comment.delete', 'uses' => 'CommentController@destroy']);
    });

    $api->group(['prefix' => 'clients'], function ($api) {      
        $api->get('', ['as' => 'api.clients', 'uses' => 'ClientController@index']);
        $api->get('show/{id}', ['as' => 'api.clients.show', 'uses' => 'ClientController@show']);
        $api->post('update/{id}', ['as' => 'api.clients.update', 'uses' => 'ClientController@update']);
        $api->post('create', ['as' => 'api.clients.create', 'uses' => 'ClientController@store']);               
        $api->delete('{id}', ['as' => 'api.clients.delete', 'uses' => 'ClientController@destroy']);
    });
       
    $api->group(['prefix' => 'invoices'], function ($api) {      
        $api->get('', ['as' => 'api.invoices', 'uses' => 'InvoiceController@index']);
        $api->get('show/{id}', ['as' => 'api.invoices.show', 'uses' => 'InvoiceController@show']);
        $api->post('update/{id}', ['as' => 'api.invoices.update', 'uses' => 'InvoiceController@update']);
        $api->post('create', ['as' => 'api.invoices.create', 'uses' => 'InvoiceController@store']);              
        $api->post('delete/{id}', ['as' => 'api.invoices.delete', 'uses' => 'InvoiceController@destroy']);
    });
     
    $api->group(['prefix' => 'user'], function ($api) {
        $api->get('all', ['as' => 'api.user.all', 'uses' => 'UserController@index']);
        $api->get('me', ['as' => 'api.user.me', 'uses' => 'AuthController@getAuthenticatedUser']);
        $api->post('logout', ['as' => 'api.user.logout', 'uses' => 'AuthController@logout']);
        $api->post('refreshtoken', ['as' => 'api.user.refresh', 'uses' => 'AuthController@refreshToken']);
        $api->post('updateuserdata', ['as' => 'api.user.udpate.data', 'uses' =>'UserController@updateUserData']);
        $api->post('updatepassword', ['as' => 'api.user.update.password', 'uses' =>'UserController@updateUserPassword']);  
        $api->post('changerole', ['as' => 'api.user.changerole', 'uses' =>'UserController@changeRole']);     
        $api->post('status', ['as' => 'api.user.status', 'uses' => 'UserController@changeStatus']);
        $api->post('delete', ['as' => 'api.user.delete', 'uses' => 'UserController@deleteUser']);
        $api->get('show/{id}', ['as' => 'api.user.show', 'uses' => 'UserController@show']);
    });
    
    
});
