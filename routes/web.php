<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/upload-file',function(){
//     return view('uploadfile');
// });

// Route::post('/upload-file',function(){
//     if(request()->has('ufile')){
//         $data=array_map('str_getcsv',file(request()->ufile));
//         $header=$data[0];
//         unset($data[0]);
//         return $data;
//     }
// });

Route::get('/upload-file', [App\Http\Controllers\leadController::class, 'index']);
Route::post('/upload-file', [App\Http\Controllers\leadController::class, 'upload']);
Route::get('/store-file', [App\Http\Controllers\leadController::class, 'store']);
