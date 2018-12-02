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

Route::group(['middleware' => ['web','auth'], 'prefix' => '/crawl'],function() {
    Route::resource('/', 'CrawlController');
    Route::get('/test','CrawlController@testCrawler');
});


Route::group(['middleware' => ['web','auth'], 'prefix' => '/task'],function() {
    Route::resource('/', 'TaskController');
    Route::get('/test','TaskController@testTask');
});

Route::group(['middleware' => ['web','auth'], 'prefix' => '/news'],function() {
    Route::get('/',
        ['as' => 'news.index',
            'uses' => 'NewsController@index',
            'middleware' => ['permission:news-list|news-create|news-edit|news-delete']
        ]);
    Route::post('/create',
        ['as' => 'news.store',
            'uses' => 'NewsController@store',
            'middleware' => ['permission:news-create']
        ]);
    Route::get('/{id}',
        ['as' => 'news.show',
            'uses' => 'NewsController@show',
            'middleware' => ['permission:news-list']
        ]);
    Route::get('/{id}/edit',
        ['as' => 'news.edit',
            'uses' => 'NewsController@edit',
            'middleware' => ['permission:news-create']
        ]);
    Route::patch('/{id}',
        ['as' => 'news.update',
            'uses' => 'NewsController@update',
            'middleware' => ['permission:news-create']
        ]);
    Route::delete('/{id}',
        ['as' => 'news.destroy',
            'uses' => 'NewsController@destroy',
            'middleware' => ['permission:news-delete']
        ]);
});


Route::group(['middleware' => ['web','auth'], 'prefix' => '/agent'],function() {
    Route::get('/task',
        ['as' => 'agent.task',
            'uses' => 'AgentController@task',
            'middleware' => ['permission:agent-create|agent-edit|agent-delete']
        ]);
    Route::get('/news',
        ['as' => 'agent.news',
            'uses' => 'AgentController@news',
            'middleware' => ['permission:agent-create|agent-edit|agent-delete']
        ]);
    Route::get('/',
        ['as' => 'agent.index',
            'uses' => 'AgentController@index',
            'middleware' => ['permission:agent-list|agent-create|agent-edit|agent-delete']
        ]);
    Route::post('/create',
        ['as' => 'agent.store',
            'uses' => 'AgentController@store',
            'middleware' => ['permission:agent-create']
        ]);
    Route::get('/{id}',
        ['as' => 'agent.show',
            'uses' => 'AgentController@show',
            'middleware' => ['permission:agent-edit']
        ]);
    Route::get('/{id}/edit',
        ['as' => 'agent.edit',
            'uses' => 'AgentController@edit',
            'middleware' => ['permission:agent-edit']
        ]);
    Route::patch('/{id}',
        ['as' => 'agent.update',
            'uses' => 'AgentController@update',
            'middleware' => ['permission:agent-edit']
        ]);
    Route::delete('/{id}',
        ['as' => 'agent.destroy',
            'uses' => 'AgentController@destroy',
            'middleware' => ['permission:agent-delete']
        ]);
});


Route::group(['middleware' => ['web','auth'], 'prefix' => '/categories'],function() {
    Route::get('/',
        ['as' => 'categories.index',
            'uses' => 'CategoriesController@index',
            'middleware' => ['permission:category-list|category-create|category-edit|category-delete']
        ]);
    Route::get('/crawl',
        ['as' => 'categories.crawl',
            'uses' => 'CategoriesController@crawlCategories',
            'middleware' => ['permission:category-create']
        ]);
    Route::get('/add',
        ['as' => 'categories.add',
            'uses' => 'CategoriesController@addNewsCategory',
            'middleware' => ['permission:category-create']
        ]);
    Route::post('/crawl',
        ['as' => 'categories.crawl.store',
            'uses' => 'CategoriesController@crawlCategoriesCreate',
            'middleware' => ['permission:category-create']
        ]);
    Route::post('/create',
        ['as' => 'categories.store',
            'uses' => 'CategoriesController@store',
            'middleware' => ['permission:category-create']
        ]);
    Route::get('/{id}',
        ['as' => 'categories.show',
            'uses' => 'CategoriesController@show',
            'middleware' => ['permission:category-list']
        ]);
    Route::get('/{id}/edit',
        ['as' => 'categories.edit',
            'uses' => 'CategoriesController@edit',
            'middleware' => ['permission:category-edit']
        ]);
    Route::patch('/{id}',
        ['as' => 'categories.update',
            'uses' => 'CategoriesController@update',
            'middleware' => ['permission:category-edit']
        ]);
    Route::delete('/{id}',
        ['as' => 'categories.destroy',
            'uses' => 'CategoriesController@destroy',
            'middleware' => ['permission:category-delete']
        ]);
});