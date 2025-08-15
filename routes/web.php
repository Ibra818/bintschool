<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\{userRqt,};
use Illuminate\Support\Facades\{Hash, Auth, Session, DB, Mail,};
use Illuminate\Support\{Str};
use App\Http\Controllers\{userCtr, };

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/home', function(){
    return view('pages.home');
})->name('home');

Route::post('register', [userCtr::class, 'register'])-> name('register');
Route::post('login', [userCtr::class, 'login'])-> name('login');
Route::post('/userRole', [userCtr::class, 'userRole'])->name('userRole');
Route::post('/resetPassword', [userCtr::Class, 'resetPassword']);
Route::delete('del-user', [userCtr::class, 'delUser']);
Route::post('/pay-cour', [userCtr::class, 'payCour']);