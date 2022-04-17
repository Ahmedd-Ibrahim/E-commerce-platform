<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

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
// Route::get('login', function () {
//     $id = '483208533448654';
//     $secret = '11949aa3ab92c359d4fae08a5b114132';
// });
Route::get('/', function () {
    return Category::childrens()->get();
    return 'test';
});
