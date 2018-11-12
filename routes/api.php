<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// login for user
Route::post('/login', 'AuthenticateController@login');

////Route::group(['middleware' => 'jwt.auth'], function () {

// get user    
Route::get('/user', 'AuthenticateController@user');
// logged out for user
Route::post('/logout', 'AuthenticateController@logout');

// List divides
Route::get('divides', 'DivideController@index');
// List single divide 
Route::get('divide/{id}', 'DivideController@show');
// Create new divide
Route::post('divide', 'DivideController@store');
// Update divide
Route::put('divide', 'DivideController@store');
// Delete divide
Route::delete('divide/{id}', 'DivideController@destroy');

// List technologies
Route::get('technologies', 'TechnologyController@index');
// List single technology 
Route::get('technology/{id}', 'TechnologyController@show');
// Create new technology
Route::post('technology', 'TechnologyController@store');
// Update technology
Route::put('technology', 'TechnologyController@store');
// Delete technology
Route::delete('technology/{id}', 'TechnologyController@destroy');

// List comments
Route::get('comments', 'CommentController@index');
// List single comment 
Route::get('comment/{id}', 'CommentController@show');
// Create new comment
Route::post('comment', 'CommentController@store');
// Update comment
Route::put('comment', 'CommentController@store');
// Delete comment
Route::delete('comment/{id}', 'CommentController@destroy');

// List works
Route::get('works', 'WorkController@index');
// List single work 
Route::get('work/{id}', 'WorkController@show');
// Create new work
Route::post('work', 'WorkController@store');
// Update work
Route::put('work', 'WorkController@store');
// Delete work
Route::delete('work/{id}', 'WorkController@destroy');

////});


