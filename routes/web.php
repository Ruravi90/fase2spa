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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::name('home_path')->get('/', 'ScheduleController@index');
 	Route::name('schedule_path')->get('/schedules', 'ScheduleController@index');
    Route::get('/api/schedules', 'ScheduleController@getAll');
    Route::get('/api/schedules/{id}', 'ScheduleController@find');
    Route::post('/api/schedules', 'ScheduleController@add');
    Route::put('/api/schedules/{id}', 'ScheduleController@update');
    Route::delete('/api/schedules/{id}', 'ScheduleController@delete');

    Route::name('clients_path')->get('/clients', 'ClientController@index');
    Route::get('/api/clients', 'ClientController@getAll');
    Route::get('/api/clients/{id}', 'ClientController@find');
    Route::post('/api/clients', 'ClientController@add');
    Route::put('/api/clients/{id}', 'ClientController@update');
    Route::delete('/api/clients/{id}', 'ClientController@delete');

    Route::name('provider_path')->get('/providers', 'ProviderController@index');
    Route::get('/api/providers', 'ProviderController@getAll');
    Route::get('/api/providers/{id}', 'ProviderController@find');
    Route::post('/api/providers', 'ProviderController@add');
    Route::put('/api/providers/{id}', 'ProviderController@update');
    Route::delete('/api/providers/{id}', 'ProviderController@delete');

    Route::name('creditor_path')->get('/creditors', 'CreditorController@index');
    Route::get('/api/creditors', 'CreditorController@getAll');
    Route::get('/api/creditors/{id}', 'CreditorController@find');
    Route::post('/api/creditors', 'CreditorController@add');
    Route::put('/api/creditors/{id}', 'CreditorController@update');
    Route::delete('/api/creditors/{id}', 'CreditorController@delete');

    Route::name('user_path')->get('/users', 'UserController@index');
    Route::get('/api/users', 'UserController@getAll');
    Route::get('/api/users/{id}', 'UserController@find');
    Route::post('/api/users', 'UserController@add');
    Route::put('/api/users/{id}', 'UserController@update');
    Route::delete('/api/users/{id}', 'UserController@delete');

    Route::name('rol_path')->get('roles', 'RolController@index');
    Route::get('/api/roles', 'RolController@getAll');
    Route::get('/api/roles/{id}', 'RolController@find');
    Route::post('/api/roles', 'RolController@add');
    Route::put('/api/roles/{id}', 'RolController@update');
    Route::delete('/api/roles/{id}', 'RolController@delete');

    Route::get('/api/permissions', 'PermissionController@getAll');
    Route::get('/api/permissions/{id}', 'PermissionController@find');
    Route::post('/api/permissions', 'PermissionController@add');
    Route::post('/api/permissions/{id}', 'PermissionController@toAssign');
    Route::put('/api/permissions/{id}', 'PermissionController@update');
    Route::delete('/api/permissions/{id}', 'PermissionController@delete');

    Route::name('cat_reference_path')->get('/cat_references', 'CatReferenceController@index');
    Route::get('/api/cat_references', 'CatReferenceController@getAll');
    Route::get('/api/cat_references/{id}', 'CatReferenceController@find');
    Route::post('/api/cat_references', 'CatReferenceController@add');
    Route::put('/api/cat_references/{id}', 'CatReferenceController@update');
    Route::delete('/api/cat_references/{id}', 'CatReferenceController@delete');

    Route::name('cat_package_path')->get('/cat_packages', 'CatPackageController@index');
    Route::get('/api/cat_packages', 'CatPackageController@getAll');
    Route::get('/api/cat_packages/{id}', 'CatPackageController@find');
    Route::post('/api/cat_packages', 'CatPackageController@add');
    Route::put('/api/cat_packages/{id}', 'CatPackageController@update');
    Route::delete('/api/cat_packages/{id}', 'CatPackageController@delete');

    Route::name('cat_product_path')->get('/cat_products', 'CatProductController@index');
    Route::get('/api/cat_products', 'CatProductController@getAll');
    Route::get('/api/cat_products/{id}', 'CatProductController@find');
    Route::post('/api/cat_products', 'CatProductController@add');
    Route::put('/api/cat_products/{id}', 'CatProductController@update');
    Route::delete('/api/cat_products/{id}', 'CatProductController@delete');

    Route::name('cat_pill_path')->get('/cat_pills', 'CatPillController@index');
    Route::get('/api/cat_pills', 'CatPillController@getAll');
    Route::get('/api/cat_pills/{id}', 'CatPillController@find');
    Route::post('/api/cat_pills', 'CatPillController@add');
    Route::put('/api/cat_pills/{id}', 'CatPillController@update');
    Route::delete('/api/cat_pills/{id}', 'CatPillController@delete');

    Route::name('cat_service_path')->get('/cat_services', 'CatServiceController@index');
    Route::get('/api/cat_services', 'CatServiceController@getAll');
    Route::get('/api/cat_services/{id}', 'CatServiceController@find');
    Route::post('/api/cat_services', 'CatServiceController@add');
    Route::put('/api/cat_services/{id}', 'CatServiceController@update');
    Route::delete('/api/cat_services/{id}', 'CatServiceController@delete');

    Route::name('sale_path')->get('/sales', 'SaleController@index');

    Route::name('products_inventory_path')->get('/products_inventory', 'ProductInventoryController@index');

    Route::name('pills_inventory_path')->get('/pills_inventory', 'PillInventoryController@index');

    Route::name('payment_path')->get('/payments', 'PaymentController@index');

});

