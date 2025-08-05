<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\{userRqt,};
use Illuminate\Support\Facades\{Hash, Auth, Session, DB, Mail,};
use Illuminate\Support\{Str};

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/home', function(){
    return view('pages.home');
})->name('home');

Route::post('register', function(userRqt $request){

        try{

            // $request->validate([
            //     'username' => 'required|string|max:255',
            //     'email' => 'required|string|email|max:255|unique:users',
            //     'password' => 'required|string|min:8',
            //     'confirm_password' => 'required|string|same:password',
            // ]);


            if($request -> password == $request -> confirm_password){
                
                $user = User::create([
                    'name' => $request -> username,
                    'email' => $request -> email,
                    'password' => Hash::make($request->password),
                ]);
                Auth::login($user);
            }else{
                return response() ->json(['status' => 400, 'message' => 'Passwords do not match']);
            }
        }catch(Exception $e){
            return response() ->json(['status' => 400, 'message' => 'Register failed']);
        }
    
    
        return response()->json(['status' => 200, 'message' => 'Register successful']);
    
})-> name('register');

Route::post('login', function(Request $request){
    $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);

    try{
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response() ->json(['status' => 400, 'message' => 'Login failed, check on your credentials']);
        }
    }catch(Exception $e){
        return response() -> json(['status' => 400, 'message' => 'Login failed, check on your credentials']);
    }
    
    Auth::login($user);
    return response() -> json(['redirect' => route('home')]);
})-> name('login');

Route::post('/userRole', function(Request $request){
    $user = auth() -> user();
    $user -> role = $request -> profile;
    $user -> save();

    return response() -> json(['redirect' => route('home')]);
})->name('userRole');
   

Route::post('/resetPassword', function(Request $request){
    
    try{
        $password = Str::random(8);
        $user = User::where('email', $request -> email) -> first();
        if(!$user){
            return response() -> json(['status' => 400, 'message' => 'Ce utilisateur n\'existe pas']);
        }
        $user -> password = Hash::make($password);
        $user -> save();
        Mail::raw("Votre nouveau mot de passe réinitialé est : $password", function($message) use ($user){
            $message -> to($user -> email) -> subject('Mail de réinitialisation de mot de passe');
        });
        return response() -> json([ 'status' => 200, 'message' => 'Votre mot de passe a été réinitialisé']);
    }catch(Exception $e){
        return response() -> json(['status' => 400, 'La rénitialisation a échoué. Assurez-vous que votre compte existe']);
    }
    
});