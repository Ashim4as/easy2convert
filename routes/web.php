<?php

use App\Http\Controllers\XmlToExcelController;
use App\Http\Controllers\ExcelMergeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [XmlToExcelController::class, 'index']);
Route::post('/convert', [XmlToExcelController::class, 'convert']);
Route::get('/download/{filename}', [XmlToExcelController::class, 'download']);

Route::get('/merge', [ExcelMergeController::class, 'index']);
Route::post('/merge', [ExcelMergeController::class, 'merge']);
Route::get('/download-merged/{filename}', [ExcelMergeController::class, 'download']);