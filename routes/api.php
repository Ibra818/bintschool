<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('tryin', function(Request $request){
    return response() -> json($request);
});
?>