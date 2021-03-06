<?php

Route::view('/', 'welcome')->name('home');

Route::get('canchas', 'CourtsController@index')->name('courtss.index')->middleware('auth');
Route::get('canchas/{court}', 'CourtsController@show')->name('courts.show')->middleware('auth');

Route::get('campeonatos', 'ChampionshipsController@index')->name('championshipss.index')->middleware('auth');
Route::get('campeonatos/{championship}', 'ChampionshipsController@show')->name('championships.show')->middleware('auth');

Route::post('campeonatos/{championship}/equipos', 'TeamsController@store')->name('teams.store')->middleware('auth');
Route::get('campeonatos/equipos/{team}', 'TeamsController@show')->name('teams.show')->middleware('auth');
Route::get('equipos', 'TeamsController@index')->name('teams.index')->middleware('auth');

Route::post('planilla/{team}', 'SheetsController@store')->name('sheets.store')->middleware('auth');
Route::delete('planilla/{sheet}/{team}', 'SheetsController@destroy')->name('sheets.destroy')->middleware('auth');


Route::get('events/{court}/show', 'EventsController@show')->name('events.show')->middleware('auth');
Route::post('events/{court}', 'EventsController@store')->name('events.store')->middleware('auth');
Route::post('events/{court}/championship', 'EventsController@storec')->name('events.storec')->middleware('auth');
Route::delete('events/{court}/{event}', 'EventsController@destroy')->name('events.destroy')->middleware('auth');
Route::put('events/{court}/{event}', 'EventsController@update')->name('events.update')->middleware('auth');


// Statuses routes
Route::get('statuses', 'StatusesController@index')->name('statuses.index');
Route::get('statuses/{status}', 'StatusesController@show')->name('statuses.show');
Route::post('statuses', 'StatusesController@store')->name('statuses.store')->middleware('auth');

// Statuses Likes routes
Route::post('statuses/{status}/likes', 'StatusLikesController@store')->name('statuses.likes.store')->middleware('auth');
Route::delete('statuses/{status}/likes', 'StatusLikesController@destroy')->name('statuses.likes.destroy')->middleware('auth');

// Statuses Comments routes
Route::post('statuses/{status}/comments', 'StatusCommentsController@store')->name('statuses.comments.store')->middleware('auth');

// Comments Likes routes
Route::post('comments/{comment}/likes', 'CommentLikesController@store')->name('comments.likes.store')->middleware('auth');
Route::delete('comments/{comment}/likes', 'CommentLikesController@destroy')->name('comments.likes.destroy')->middleware('auth');

// Users routes
Route::get('@{user}', 'UsersController@show')->name('users.show');

// Users statuses routes
Route::get('users/{user}/statuses', 'UsersStatusController@index')->name('users.statuses.index');

// Friends routes
Route::get('friends', 'FriendsController@index')->name('friends.index')->middleware('auth');

// Friendships routes
Route::get('friendships/{recipient}', 'FriendshipsController@show')->name('friendships.show')->middleware('auth');
Route::post('friendships/{recipient}', 'FriendshipsController@store')->name('friendships.store')->middleware('auth');
Route::delete('friendships/{user}', 'FriendshipsController@destroy')->name('friendships.destroy')->middleware('auth');

// Accept Friendships routes
Route::get('friends/requests', 'AcceptFriendshipsController@index')->name('accept-friendships.index')->middleware('auth');
Route::post('accept-friendships/{sender}', 'AcceptFriendshipsController@store')->name('accept-friendships.store')->middleware('auth');
Route::delete('accept-friendships/{sender}', 'AcceptFriendshipsController@destroy')->name('accept-friendships.destroy')->middleware('auth');

// Notification routes
Route::get('notifications', 'NotificationsController@index')->name('notifications.index')->middleware('auth');

// Read Notification routes
Route::post('read-notifications/{notification}', 'ReadNotificationsController@store')->name('read-notifications.store')->middleware('auth');
Route::delete('read-notifications/{notification}', 'ReadNotificationsController@destroy')->name('read-notifications.destroy')->middleware('auth');

//Route Admin
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth',],
    function(){
        Route::get('/', 'AdminController@index')->name('dashboard');

        Route::resource('courts', 'CourtsController', ['excepet' => 'show', 'as' => 'admin']);
        Route::resource('championships', 'ChampionshipsController', ['excepet' => 'show', 'as' => 'admin']);

        Route::post('courts/{court}/photos', 'PhotosController@store')->name('admin.courts.photos.store');
        Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');

        Route::get('championships/{championship}','StatisticsController@index')->name('admin.statistics.index');
        Route::get('championships/{championship}/{team}', 'StatisticsController@edit')->name('admin.statistics.edit');
        Route::put('championships/{championship}/{team}', 'StatisticsController@update')->name('admin.statistics.update');

        Route::post('championships/{championship}/photoos', 'PhotoosController@store')->name('admin.championships.photoos.store');
        Route::delete('photoos/{photoo}', 'PhotoosController@destroy')->name('admin.photoos.destroy');
    });

Route::auth();
