<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\Type2ExcelController;
use App\Http\Controllers\Type3ExcelController;

Route::get('/', function () {
    return view('home');
});

// Type1
Route::post('/import' ,[ExcelController::class , 'import'])->name("excel.import");
Route::get('/export' ,[ExcelController::class , 'export'])->name("excel.export");

//Type2 
Route::post('/type2-import' , [Type2ExcelController::class , 'import'])->name("type2.import");
Route::post('/type2-export' , [Type2ExcelController::class , 'export'])->name("type2.export");

//Type3
Route::post('/type3-import' , [Type3ExcelController::class , 'import'])->name('type3.import');
Route::post('/type3-export' , [Type3ExcelController::class , 'export'])->name('type3.export');