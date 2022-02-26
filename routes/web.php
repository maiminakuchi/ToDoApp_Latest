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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'auth'],function(){

    Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
    // Route::get('/folders/1/tasks',[TaskController::class,'index'])->name('tasks.index');

    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
    //２.１９追加.新規フォルダ作成→POST送信して完了ページ（自動リダイレクト）
    Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', 'TaskController@create');
    //２.１９追加.新規タスク作成→POST送信して完了ページ（自動リダイレクト）
    Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');
    //２.２１追加.タスク編集→POST送信して完了ページ（自動リダイレクト）
    Route::get('/', 'HomeController@index')->name('home');
    // Auth::routes();
    //2.23追加
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
