<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{userRqt,};
use Illuminate\Support\Facades\{Hash, Auth, Session, DB, Mail, Http,};
use Illuminate\Support\{Str};
use App\Models\{User, };

class userCtr extends Controller
{

    // Register function
     public function register(userRqt $request){

        try{

            Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]) -> post('http://localhost:8001/api/register', [ 'name' => $request -> username]);

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
    
    }

    // Login

    public function login(Request $request){

        $request -> validate([
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

        if(Auth::user() -> role == 'admin'){
            return response() -> json (['redirect' => route('admin-home')]);
        }else{
            return response() -> json(['redirect' => route('home')]);
        }

    }

    // Define the role of a user while his creating his account

    public function userRole(Request $request){

        $user = auth() -> user();
        $user -> role = $request -> profile;
        $user -> save();

        return response() -> json(['redirect' => route('home')]);
    }

    // Reset the user password
    public function resetPassword(Request $request){
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
    }

    //  Deletion of the account 

    public function delUser(Request $request){
        $user = User::findOrFail($request -> id);

        $user -> delete();
        return response() -> json(['message' => 'Votre compte a été supprimé, revenez a tout moment!']);
    }

    public function changeUserInfo(Request $request){
        return response() -> json($request);
    }
    public function payCour(Request $request){
        
        return response() -> json($request);
    }
}
