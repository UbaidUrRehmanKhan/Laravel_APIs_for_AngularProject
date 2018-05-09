<?php

use Illuminate\Http\Request;
use function foo\func;
use App\User;
use App\Task;
use App\Http\Controllers\UserController;
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





Route::group([], function ($router) {

    //To login of a user 
    Route::post('login', 'AuthController@login');
    //To logout of a user
    Route::post('logout', 'AuthController@logout');
    //For user refresh (must find the purpose?)
    Route::post('refresh', 'AuthController@refresh');
    //(must find the purpose?)
    Route::Post('me', 'AuthController@me');


    //User Routes
    Route::Post('registerUser', 'UserController@create');
    Route::get('getUsers', 'UserController@getUsers');
    Route::put('updateUser', 'UserController@updateUser');
    Route::put('updateStatus/{id}/{status}', 'UserController@updateUserStatus');
    Route::get('user/{id}/tasks', 'UserController@getUserTasks');//to get all the tasks against a single user
    Route::get('user/{user}', 'UserController@getUser');
    Route::get('user/{userId}/tasks/{taskId}', 'UserController@getUserTask');//to get a single task against a single user
    Route::put('user/{userId}/tasks/{taskId}','UserController@updateTaskStatus');
    //Task Routes
    Route::Post('registerTask', 'TaskController@create'); 
    Route::Post('assigningUsers/{id}', 'TaskController@assigningUsers'); 
    Route::get('detachingUser/{userId}/{taskId}', 'TaskController@detachingUser'); 
    Route::get('getTasks', 'TaskController@getTasks');
    Route::get('getTask/{task}', 'TaskController@getTask');
    Route::put('updateTask', 'TaskController@updateTask');
    Route::delete('deleteTask/{id}', 'TaskController@deleteTask');
    Route::get('task/{id}/users', 'TaskController@getTaskUsers');//to get all the users against a single task

    //Feedback Routes
    Route::Post('registerFeedback/{user}/{task}', 'FeedbackController@createFeedback');
    Route::delete('deleteFeedback/{id}', 'FeedbackController@deleteFeedback');
    Route::get('viewFeedbacks/{user}/{task}', 'FeedbackController@viewFeedbacks');
});


