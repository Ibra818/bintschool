<?php

use App\Models\{User, Formation};
use Illuminate\Http\Request;
use App\Http\Requests\{userRqt,};
use Illuminate\Support\Facades\{Hash, Auth, Session, DB, Mail, Http, Route};
use Illuminate\Support\{Str};
use App\Http\Controllers\{userCtr, moduleCtr, };
use App\Models\{Module, };

Route::get('/', function () {

    // $response = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json']) 
    //     -> post('http://localhost:8001/api/login', ['email' => $request -> email, 'password' -> $request -> password]);

    return view('pages.login');
});


Route::get('/home', function(){
    
    return view('pages.home');
})->name('home');

Route::get('/sendSingleFormation/{id}', function (Request $request){

    // $formation = Formation::where('id', $request -> id) -> get();

    return view('pages.formation');
});

Route::get('admin-home', function(){
    return view('pages.admin-home');
}) ->name('admin-home');

Route::get('formation', function(request $request){
    // $response = Http::withHeaders(['Content-Tpye' => 'application/json', 'Accept' => 'application/json']) -> get('http://localhost:8001/api/formations');
    // $response = $response -> json();
});

// Route::post('register', [userCtr::class, 'register'])-> name('register');
// Route::post('login', [userCtr::class, 'login'])-> name('login');
// Route::post('/userRole', [userCtr::class, 'userRole'])->name('userRole');
// Route::post('/resetPassword', [userCtr::class, 'resetPassword']);
// Route::delete('del-user', [userCtr::class, 'delUser']);
// Route::post('/pay-cour', [userCtr::class, 'payCour']);
// Route::put('/change-user-info', [userCtr::class, 'changeUserInfo']);
// Route::post('/addmodule', [moduleCtr::class, 'storeModule']) ->name('addmodule');
