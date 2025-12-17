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

// ---------- Landing & Home ----------
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('home')
        : redirect()->route('search.view');
});

Route::get('/home', 'KeyboardController@home')->name('home')->middleware('auth');

// ---------- Guest Routes ----------
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', 'UserController@checkLogin')->name('login.attempt');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', 'UserController@register')->name('register.attempt');
    Route::get('/searchview','VisitorController@searchView')->name('search.view');
    Route::get('/searchResults','VisitorController@searchResults')->name('search.results');
});

// ---------- Authenticated Routes ----------
Route::middleware('auth')->group(function () {
    Route::get('/logout', 'UserController@logout')->name('logout');

    // Profile Management
    Route::get('/profile', 'UserController@editProfile')->name('profile.edit');
    Route::put('/profile', 'UserController@updateProfile')->name('profile.update');
    Route::put('/profile/password', 'UserController@updatePassword')->name('profile.password.update');
});

// ---------- Admin Only Routes ----------
// IMPORTANT: Admin routes with specific paths (create, edit) MUST be defined BEFORE
// auth routes with parameters ({keyboard}) to avoid route conflicts
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/keyboards/create', 'KeyboardController@create')->name('keyboards.create');
    Route::post('/keyboards', 'KeyboardController@store')->name('keyboards.store');
    Route::get('/keyboards/{keyboard}/edit', 'KeyboardController@edit')->name('keyboards.edit');
    Route::put('/keyboards/{keyboard}', 'KeyboardController@update')->name('keyboards.update');
    Route::delete('/keyboards/{keyboard}', 'KeyboardController@destroy')->name('keyboards.destroy');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

    // Admin - Order Management
    Route::get('/admin/orders', 'OrderController@adminIndex')->name('orders.admin');
    Route::put('/orders/{order}/status', 'OrderController@updateStatus')->name('orders.updateStatus');

    // Admin - Top-Up Management
    Route::get('/admin/topups', 'TopUpController@adminIndex')->name('topups.admin');
    Route::put('/topups/{topup}/approve', 'TopUpController@approve')->name('topups.approve');
    Route::put('/topups/{topup}/reject', 'TopUpController@reject')->name('topups.reject');
});

// ---------- Authenticated Routes (Keyboards View Only) ----------
// Must be after admin routes to prevent route conflicts
Route::middleware('auth')->group(function () {
    Route::get('/keyboards', 'KeyboardController@index')->name('keyboards.index');
    Route::get('/keyboards/{keyboard}', 'KeyboardController@show')->name('keyboards.show');

    // Orders - Guest can buy and view their orders
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

    // Top-Up - Guest can request and view their top-up history
    Route::get('/topups', 'TopUpController@index')->name('topups.index');
    Route::get('/topups/create', 'TopUpController@create')->name('topups.create');
    Route::post('/topups', 'TopUpController@store')->name('topups.store');
});
