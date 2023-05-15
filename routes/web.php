<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
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



 //login routes // 

Route::get('/', [AuthController::class,'index']); 
Route::post('/authenticate', [AuthController::class,'create']); 
Route::get('/logout', [AuthController::class,'logout']); 


Route::group(['middleware'=> 'admin'],function(){

// dashbord routes // 
	
	Route::get('/admin/dashbord', [DashbordController::class,'index']); 

//companies routes // 

	Route::get('/comapnies/list', [CompanyController::class,'show']); 
	Route::get('/add/company', [CompanyController::class,'index']); 
	Route::post('/company/store', [CompanyController::class,'store']); 
	Route::get('/edit/company/{id}', [CompanyController::class,'edit']); 
	Route::post('/company/update/{id}', [CompanyController::class,'update']); 
	Route::post('/delete/company', [CompanyController::class,'destroy']); 

// employees routes //

	Route::get('/employee/list', [EmployeeController::class,'show']); 
	Route::get('/add/employee', [EmployeeController::class,'index']); 
	Route::post('/employee/store', [EmployeeController::class,'store']); 
	Route::get('/edit/employee/{id}', [EmployeeController::class,'edit']); 
	Route::post('/employee/update/{id}', [EmployeeController::class,'update']); 
	Route::post('/delete/employee', [EmployeeController::class,'destroy']); 
});
