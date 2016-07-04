<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    /**
     * Browser
     */
    Route::get('/', ['uses' => 'HomeController@index']);
    Route::get('/book/{id}/{slug}', ['uses' => 'BookController@show', 'where' => ['id' => '[0-9]+',]]);
    Route::get('/author/{id}/{slug}', ['uses' => 'AuthorController@show', 'where' => ['id' => '[0-9]+',]]);

    /**
     * Auth Routes
     */
    Route::controllers([
        'auth'     => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
    ]);


    /**
     * Member Portal
     */
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/my-profile', ['uses' => 'AdminController@getProfile',]);
        Route::get('/change-password', ['uses' => 'AdminController@getChangePassword',]);

        Route::get('/borrow-books', ['uses' => 'BorrowController@index']);
        Route::get('/return-books', ['uses' => 'BorrowController@getReturn']);
        Route::post('/return-books/{id}', ['uses' => 'BorrowController@postReturn', 'where' => ['id' => '[0-9]+',]]);
    });

    /**
     * Admin Portal
     */
    Route::group(['prefix' => 'admin'], function () {

        Route::get('login', function () {
            return view('admin.auth.login');
        });

        Route::group(['middleware' => 'auth'], function () {

            /**
             * Admin Controller
             */
            Route::get('/', ['uses' => 'AdminController@index',]);
            Route::post('/my-profile', ['uses' => 'AdminController@postProfile',]);
            Route::post('/change-password', ['uses' => 'AdminController@postChangePassword',]);

            /**
             * Author
             */
            Route::get('/author/add-new', ['uses' => 'AuthorController@create', 'middleware' => 'admin']);
            Route::post('/author', ['uses' => 'AuthorController@store', 'middleware' => 'admin']);
            Route::get('/author/{id}/edit',
                ['uses' => 'AuthorController@edit', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::post('/author/{id}',
                ['uses' => 'AuthorController@update', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/author/list', ['uses' => 'AuthorController@index']);
            Route::get('/author/search', ['uses' => 'AuthorController@getSearch']);

            /**
             * Country
             */
            Route::get('/countries', ['uses' => 'CountryController@index']);

            /**
             * Publisher
             */
            Route::get('/publisher/add-new', ['uses' => 'PublisherController@create', 'middleware' => 'admin']);
            Route::post('/publisher', ['uses' => 'PublisherController@store', 'middleware' => 'admin']);
            Route::get('/publisher/{id}/edit',
                ['uses' => 'PublisherController@edit', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::post('/publisher/{id}',
                ['uses' => 'PublisherController@update', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/publisher/list', ['uses' => 'PublisherController@index']);
            Route::get('/publisher/search', ['uses' => 'PublisherController@getSearch']);

            /**
             * Member
             */
            Route::get('/member/{id}',
                ['uses' => 'MemberController@show', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/member/add-new', ['uses' => 'MemberController@create', 'middleware' => 'admin']);
            Route::post('/member', ['uses' => 'MemberController@store', 'middleware' => 'admin']);
            Route::get('/member/{id}/edit',
                ['uses' => 'MemberController@edit', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::post('/member/{id}',
                ['uses' => 'MemberController@update', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/member/list', ['uses' => 'MemberController@index']);


            /**
             * Book
             */
            Route::post('/book', ['uses' => 'BookController@store', 'middleware' => 'admin']);
            Route::post('/book/{id}/copy', ['uses' => 'BookController@postAddCopy', 'middleware' => 'admin']);
            Route::post('/book/{id}',
                ['uses' => 'BookController@update', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::delete('/book/{id}/author/{authorId}',
                ['uses' => 'BookController@deleteAuthor', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::delete('/book/{id}/category/{categoryId}',
                ['uses' => 'BookController@deleteCategory', 'middleware' => 'admin', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/book/list', ['uses' => 'BookController@index']);
            Route::get('/book/add-new', ['uses' => 'BookController@create', 'middleware' => 'admin']);
            Route::get('/book/{id}/edit', ['uses' => 'BookController@edit', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/book/{id}/delete', ['uses' => 'BookController@getDelete', 'where' => ['id' => '[0-9]+',]]);
            Route::post('/book/{id}/copy/{copyId}',
                ['uses' => 'BookController@postUpdateCopy', 'where' => ['id' => '[0-9]+',]]);
            Route::delete('/book/{id}/copy/{copyId}',
                ['uses' => 'BookController@deleteCopy', 'where' => ['id' => '[0-9]+',]]);
            Route::delete('/book/{id}', ['uses' => 'BookController@destroy', 'where' => ['id' => '[0-9]+',]]);
            Route::get('/book/search', ['uses' => 'BookController@search']);

            /**
             * Borrow
             */
            Route::post('/borrow', ['uses' => 'BorrowController@store',]);

            /**
             * Category
             */
            Route::get('/category/search', ['uses' => 'CategoryController@getSearch']);


            /**
             * Reports
             */
            Route::get('/report/loan', ['uses' => 'ReportController@getLoan']);
            Route::get('/report/return', ['uses' => 'ReportController@getReturn']);
            Route::get('/report/balance', ['uses' => 'ReportController@getBalance']);

        });
    });