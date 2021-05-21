<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


$api = app('Dingo\Api\Routing\Router');


$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 100, 'expires' => 5],function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers',], function ($api) {
        $api->post('login', 'AuthController@login');
        $api->post('register', 'AuthController@register');   
         
    });

    $api->group(['prefix' => 'images', 'namespace' => 'App\Http\Controllers'], function ($api) {      
        $api->post('', ['as' => 'api.images.upload', 'uses' => 'ImageController@store']);
        $api->post('{fileName}', ['as' => 'api.images.delete', 'uses' => 'ImageController@delete']);
        $api->get('{fileName}', ['as' => 'api.images', 'uses' => 'ImageController@getImageUrl']);
    });

});

$api->version('v1',['middleware' => 'api.auth', 'namespace' => 'App\Http\Controllers'], function ($api) {

    $api->group(['prefix' => 'patients'], function ($api) {      
        $api->get('', ['as' => 'api.patients', 'uses' => 'PatientController@index']);
        $api->get('show/{id}', ['as' => 'api.patients.show', 'uses' => 'PatientController@show']);     
        $api->post('update/{id}', ['as' => 'api.patients.update', 'uses' => 'PatientController@update']);   
        $api->post('create', ['as' => 'api.patients.create', 'uses' => 'PatientController@store']);               
        $api->delete('{id}', ['as' => 'api.patients.delete', 'uses' => 'PatientController@destroy']);
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
    });
    
    
});
