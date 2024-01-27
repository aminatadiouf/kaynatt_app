<?php

use App\Models\Tontine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\TontineController;
use App\Http\Controllers\Api\TontineUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => [ 'jwt.auth','role:admin'],'prefix'=>'admin'], function () {

Route::POST('ajouterTontine',[TontineController::class,'demandeCreationTontine']);


});



Route::POST('registerUser',[UserController::class,'register']);
Route::POST('loginUser',[UserController::class,'login']);
Route::POST('modifierUser',[UserController::class,'update']);
Route::POST('logoutUser',[UserController::class,'logoutUser']);
Route::delete('supprimerUser',[UserController::class,'destroy']);
Route::GET('ListeUser',[UserController::class,'touslesUtilisateurs']);

Route::GET('indexUser',[UserController::class,'index']);


// Route::POST('registerAdmin',[AdminController::class,'registerAdmin']);
Route::POST('loginAdmin',[AdminController::class,'loginAdmin']);
Route::POST('logoutAdmin',[AdminController::class,'logoutAdmin']);
Route::GET('indexAdmin',[AdminController::class,'index']);




Route::GET('getAdmin',[TontineController::class,'index']);
//Route::POST('ajouterTontine',[TontineController::class,'demandeCreationTontine']);
Route::POST('modifierTontine/{tontines}',[TontineController::class,'update']);
Route::GET('ListeTontine',[TontineController::class,'tousLesTontines']);
Route::delete('supprimerTontine/{tontines}',[TontineController::class,'destroy']);



//Route::POST('demandePartiTontine',[TontineUserController::class,'ParticiperTontine']);
Route::POST('demandeCreationAccepte',[TontineUserController::class,'AccepteDemandeTontine']);


Route::group(['middleware' => [ 'jwt.auth','role:participant_tontine'],'prefix'=>'participant_tontine'], function () {

    Route::POST('demandePartiTontine/{users}',[TontineUserController::class,'ParticiperTontine']);


});