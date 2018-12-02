<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/crawl','HomeController@getUrl')->name('crawle');

Route::group(['prefix' => '/roles','middleware' => ['auth']], function() {
    Route::get('/',
        ['as'=>'roles.index',
            'uses'=>'RolesController@index',
            'middleware' => ['permission:role-list|role-create|role-edit|role-delete']
        ]);
    Route::get('/create',
        ['as'=>'roles.create',
            'uses'=>'RolesController@create',
            'middleware' => ['permission:role-create']
        ]);
    Route::post('/create',
        ['as'=>'roles.store',
            'uses'=>'RolesController@store',
            'middleware' => ['permission:role-create']
        ]);
    Route::get('/{id}',
        ['as'=>'roles.show',
            'uses'=>'RolesController@show'
        ]);
    Route::get('/{id}/edit',
        ['as'=>'roles.edit',
            'uses'=>'RolesController@edit',
            'middleware' => ['permission:role-edit']
        ]);
    Route::patch('/{id}',
        ['as'=>'roles.update',
            'uses'=>'RolesController@update',
            'middleware' => ['permission:role-edit']
        ]);
    Route::delete('/{id}',
        ['as'=>'roles.destroy',
            'uses'=>'RolesController@destroy',
            'middleware' => ['permission:role-delete']
        ]);
});

Route::group(['prefix' => '/users', 'middleware' => ['auth']], function() {
    Route::get('/',
        ['as'=>'users.index',
            'uses'=>'UsersController@index',
            'middleware' => ['permission:user-list|user-create|user-edit|user-delete']
        ]);
    Route::get('/create',
        ['as'=>'users.create',
            'uses'=>'UsersController@create',
            'middleware' => ['permission:user-create']
        ]);
    Route::post('/create',
        ['as'=>'users.store',
            'uses'=>'UsersController@store',
            'middleware' => ['permission:user-create']
        ]);
    Route::get('/{id}',
        ['as'=>'users.show',
            'uses'=>'UsersController@show'
        ]);
    Route::get('/{id}/edit',
        ['as'=>'users.edit',
            'uses'=>'UsersController@edit',
            'middleware' => ['permission:user-edit']
        ]);
    Route::patch('/{id}',
        ['as'=>'users.update',
            'uses'=>'UsersController@update',
            'middleware' => ['permission:user-edit']
        ]);
    Route::delete('/{id}',
        ['as'=>'users.destroy',
            'uses'=>'UsersController@destroy',
            'middleware' => ['permission:user-delete']
        ]);
});
Route::get('/avatar/{filename}',
    ['as'=>'avatar.show',
        'uses'=>'imageController@avatarShow'
    ]);

