<?php

use Illuminate\Support\Facades\Route;
use App\Models\{User, Formation};
use Illuminate\Http\Request;
use App\Http\Requests\{userRqt,};
use Illuminate\Support\Facades\{Hash, Auth, Session, DB, Mail,};
use Illuminate\Support\{Str};
use App\Http\Controllers\{userCtr, moduleCtr, };
use App\Models\{Module, };

Route::get('/', function () {
    return view('pages.login');
});


Route::get('/home', function(){

    $user = Auth::user();

    $cours =[
        [
            'id' => '1',
            'nom' =>  'cours1',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '2',
            'nom' =>  'cours2',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '3',
            'nom' =>  'cours3',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '4',
            'nom' =>  'cours4',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '5',
            'nom' =>  'cours5',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '6',
            'nom' =>  'cours6',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '7',
            'nom' =>  'cours7',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],

        [
            'id' => '8',
            'nom' =>  'cours8',
            'duree' => '4h',
            'Date_debut' => '12/8/2025',
            'Catégorie' => 'Business',
            'nom_formateur' => 'Nom formateur'
        ],
    ];

    $modules = Module::all();
    return view('pages.home', [
        'user' => $user, 
        'cours' => $cours,
        'modules' => $modules,
    ]);
})->name('home');

Route::get('/sendSingleFormation/{id}', function (Request $request){

    $formation = Formation::where('id', $request -> id) -> get();

    return view('pages.formation', compact('formation'));
}) -> name('sendSingleFormation');

Route::post('register', [userCtr::class, 'register'])-> name('register');
Route::post('login', [userCtr::class, 'login'])-> name('login');
Route::post('/userRole', [userCtr::class, 'userRole'])->name('userRole');
Route::post('/resetPassword', [userCtr::class, 'resetPassword']);
Route::delete('del-user', [userCtr::class, 'delUser']);
Route::post('/pay-cour', [userCtr::class, 'payCour']);
Route::put('/change-user-info', [userCtr::class, 'changeUserInfo']);
Route::post('/addmodule', [moduleCtr::class, 'storeModule']) ->name('addmodule');
