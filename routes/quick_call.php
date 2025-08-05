<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\addons\QuickCallController;
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

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
    Route::group(['middleware' => 'AdminAuth' ],function(){
        Route::post('quick_call', [QuickCallController::class, 'quick_call']);        
    });
});