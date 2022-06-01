<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Multitenancy\Models\Tenant;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[RegisteredUserController::class,'register']);

Route::get('/tenant/create', function (Request $request){

    Tenant::create([
        'name'=>$request->name,
        'domain'=>$request->domain,
        'database'=>$request->database,
        'address'=>$request->address,
        'phone'=>$request->phone,
    ]);
    return 'successfully create';
});

