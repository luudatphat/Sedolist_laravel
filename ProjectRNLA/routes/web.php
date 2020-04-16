<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    $data['count'] = DB::table('user')->where('device',1)->where('status',0)->count();
    $data['android_data'] = DB::table('user')->where('device',1)->where('status',0)->get();
    return view('welcome',$data);
});
