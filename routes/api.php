<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'vendors',
    'namespace' => 'Vendor'
], function () {
    Route::post('login','VendorController@login');
    Route::post('register','VendorController@register');
    Route::group([
        'middleware' => 'auth:vendor'
    ], function() {
        Route::post('logout','VendorController@logout');
    });
    Route::group([
        'prefix' => 'products',
    ], function () {
        Route::get('/','ProductController@index');
        Route::get('show','ProductController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','ProductController@store');
            Route::post('update','ProductController@update');
            Route::post('destroy','ProductController@destroy');
        });
    });
});

Route::group([
    'prefix' => 'employees',
    'namespace' => 'Employee'
], function () {
    Route::post('login','EmployeeController@login');
    Route::post('register','EmployeeController@register');
    Route::group([
        'middleware' => 'auth:employee'
    ], function() {
        Route::post('logout','EmployeeController@logout');
    });
});

Route::group([
    'prefix' => 'general',
    'namespace' => 'General'
], function () {
    Route::group([
        'prefix' => 'countries',
    ], function () {
        Route::get('/','CountryController@index');
        Route::get('show','CountryController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','CountryController@store');
            Route::post('update','CountryController@update');
            Route::post('destroy','CountryController@destroy');
        });
    });
    Route::group([
        'prefix' => 'cities',
    ], function () {
        Route::get('/','CityController@index');
        Route::get('show','CityController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','CityController@store');
            Route::post('update','CityController@update');
            Route::post('destroy','CityController@destroy');
        });
    });
    Route::group([
        'prefix' => 'banks',
    ], function () {
        Route::get('/','BankController@index');
        Route::get('show','BankController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','BankController@store');
            Route::post('update','BankController@update');
            Route::post('destroy','BankController@destroy');
        });
    });
    Route::group([
        'prefix' => 'brands',
    ], function () {
        Route::get('/','BrandController@index');
        Route::get('show','BrandController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','BrandController@store');
            Route::post('update','BrandController@update');
            Route::post('destroy','BrandController@destroy');
        });
    });
    Route::group([
        'prefix' => 'categories',
    ], function () {
        Route::get('/','CategoryController@index');
        Route::get('show','CategoryController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','CategoryController@store');
            Route::post('update','CategoryController@update');
            Route::post('destroy','CategoryController@destroy');
        });
    });
    Route::group([
        'prefix' => 'faqs',
    ], function () {
        Route::get('/','FaqController@index');
        Route::get('show','FaqController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','FaqController@store');
            Route::post('update','FaqController@update');
            Route::post('destroy','FaqController@destroy');
        });
    });
    Route::group([
        'prefix' => 'sub_categories',
    ], function () {
        Route::get('/','SubCategoryController@index');
        Route::get('show','SubCategoryController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','SubCategoryController@store');
            Route::post('update','SubCategoryController@update');
            Route::post('destroy','SubCategoryController@destroy');
        });
    });
    Route::group([
        'prefix' => 'subscriptions',
    ], function () {
        Route::get('/','SubscriptionController@index');
        Route::get('show','SubscriptionController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','SubscriptionController@store');
            Route::post('update','SubscriptionController@update');
            Route::post('destroy','SubscriptionController@destroy');
        });
    });
    Route::group([
        'prefix' => 'subscriptions',
    ], function () {
        Route::get('/','SubscriptionController@index');
        Route::get('show','SubscriptionController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','SubscriptionController@store');
            Route::post('update','SubscriptionController@update');
            Route::post('destroy','SubscriptionController@destroy');
        });
    });
    Route::group([
        'prefix' => 'subscriptions/services',
    ], function () {
        Route::get('/','SubscriptionServiceController@index');
        Route::get('show','SubscriptionServiceController@show');
        Route::group([
            'middleware' => 'auth:employee'
        ], function() {
            Route::post('store','SubscriptionServiceController@store');
            Route::post('update','SubscriptionServiceController@update');
            Route::post('destroy','SubscriptionServiceController@destroy');
        });
    });
    Route::group([
        'prefix' => 'products',
        'namespace' => 'Product'
    ], function () {
        Route::group([
            'prefix' => 'types',
        ], function () {
            Route::get('/','ProductTypeController@index');
            Route::get('show','ProductTypeController@show');
            Route::group([
                'middleware' => 'auth:employee'
            ], function() {
                Route::post('store','ProductTypeController@store');
                Route::post('update','ProductTypeController@update');
                Route::post('destroy','ProductTypeController@destroy');
            });
        });
        Route::group([
            'prefix' => 'models',
        ], function () {
            Route::get('/','ProductTypeModelController@index');
            Route::get('show','ProductTypeModelController@show');
            Route::group([
                'middleware' => 'auth:employee'
            ], function() {
                Route::post('store','ProductTypeModelController@store');
                Route::post('update','ProductTypeModelController@update');
                Route::post('destroy','ProductTypeModelController@destroy');
            });
        });
        Route::group([
            'prefix' => 'colors',
        ], function () {
            Route::get('/','ProductTypeModelColorController@index');
            Route::get('show','ProductTypeModelColorController@show');
            Route::group([
                'middleware' => 'auth:employee'
            ], function() {
                Route::post('store','ProductTypeModelColorController@store');
                Route::post('update','ProductTypeModelColorController@update');
                Route::post('destroy','ProductTypeModelColorController@destroy');
            });
        });
        Route::group([
            'prefix' => 'sizes',
        ], function () {
            Route::get('/','ProductTypeModelSizeController@index');
            Route::get('show','ProductTypeModelSizeController@show');
            Route::group([
                'middleware' => 'auth:employee'
            ], function() {
                Route::post('store','ProductTypeModelSizeController@store');
                Route::post('update','ProductTypeModelSizeController@update');
                Route::post('destroy','ProductTypeModelSizeController@destroy');
            });
        });
    });
});

Route::group([
    'prefix' => 'finance',
    'namespace' => 'Finance'
], function () {
    Route::group([
        'prefix' => 'transactions',
    ], function() {
        Route::get('/','TransactionController@index');
        Route::get('show','TransactionController@show');
        Route::post('store','TransactionController@store');
        Route::post('update','TransactionController@update');
    });
    Route::group([
        'prefix' => 'withdrawal_requests',
    ], function() {
        Route::get('/','WithdrawalRequestController@index');
        Route::get('show','WithdrawalRequestController@show');
        Route::post('store','WithdrawalRequestController@store');
        Route::post('update','WithdrawalRequestController@update');
    });
});

Route::group([
    'prefix' => 'orders',
    'namespace' => 'Order'
], function () {
    Route::get('/','OrderController@index');
    Route::get('show','OrderController@show');
    Route::post('store','OrderController@store');
    Route::post('update','OrderController@update');
});
