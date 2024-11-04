<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\PaymentController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');
route::get('/validate-account/{email}',[AdminController::class,'defineAccess']);
route::post('/validate-account/{email}',[AdminController::class,'submitDefineAccess'])->name('submitDefineAccess');


Route::middleware('auth')->group(function(){
     Route::get('dashboard',[AppController::class,'index'])->name('dashboard');
     Route::prefix('employers')->group(function(){
          Route::get('/',[EmployerController::class, 'index'])->name('employers.index');
          Route::get('/create',[EmployerController::class, 'create'])->name('employers.create');
          Route::get('/edit/{employer}',[EmployerController::class, 'edit'])->name('employers.edit');


          //Route d'action 
          Route::post('/store',[EmployerController::class, 'store'])->name('employes.store');
          Route::put('/update/{employe}',[EmployerController::class , 'update'])->name('employes.update');
          Route::get('/delete/{employe}',[EmployerController::class , 'delete'])->name('employes.delete');
     });
     Route::prefix('departements')->group(function(){
          Route::get('/',[DepartementController::class, 'index'])->name('departement.index');
          Route::get('/create',[DepartementController::class, 'create'])->name('departement.create');
          Route::post('/create',[DepartementController::class, 'store'])->name('departement.store');
          Route::get('/edit/{departement}',[DepartementController::class, 'edit'])->name('departement.edit');
          Route::put('/update/{departement}',[DepartementController::class, 'update'])->name('departement.update');

          Route::get('/{departement}',[DepartementController::class, 'delete'])->name('departement.delete');
     });
     Route::prefix('configurations')->group(function(){
          Route::get('/', [ConfigurationController::class ,'index'])->name('configurations');
          Route::get('create',[ConfigurationController::class , 'create'])->name('configurations.create');




          //routes d'action
          Route::post('/store', [ConfigurationController::class, 'store'])->name('configurations.store');
          Route::get('/delete/{configuration}', [ConfigurationController::class, 'delete'])->name('configurations.delete');
     });
     Route::prefix('administrateurs')->group(function(){
          Route::get('/',[AdminController::class,'index'])->name('administrateurs');

          Route::get('/create',[AdminController::class,'create'])
          ->name('administrateurs.create');

          Route::post('/create',[AdminController::class,'store'])
          ->name('administrateurs.store');

          route::get('/delete/{user}',[AdminController::class,'delete'])
          ->name('administrateurs.delete');
     });
     Route::prefix('payment')->group(function(){
          Route::get('/',[PaymentController::class, 'index'])->name('payments');
          Route::get('/make',[PaymentController::class, 'initPayment'])->name('payment.init');
          Route::get('/download-invoice/{payment}',[PaymentController::class,'Download_invoice'])->name('payment.download');
     });
});
