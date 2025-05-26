<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', fn()=> redirect()->route('documents.index'));

// Document routes
Route::resource('documents', DocumentController::class);

// Route tambahan untuk download
Route::get('documents/{document}/download', [DocumentController::class, 'download'])
     ->name('documents.download');

// Category routes
Route::resource('categories', CategoryController::class)->except(['show']);

// Activity logs
Route::get('logs', [ActivityLogController::class,'index'])->name('logs.index');
Route::delete('logs/clean',[ActivityLogController::class,'destroy'])->name('logs.clean');