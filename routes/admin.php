<?php

use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
->as('admin.')
->middleware(['auth', 'isAdmin'])
->group(function()
{

    Route::get('/', function(){
       return view('admin.dashboard') ;
    })->name('dashboard') ;

    Route::prefix('catelogues')
    ->as('catelogues.')
    ->group(function()
    {
        Route::get('/', [CatelogueController::class , 'index'])->name('index');
        Route::get('create', [CatelogueController::class , 'create'])->name('create'); 
        Route::post('store', [CatelogueController::class , 'store'])->name('store'); 
        Route::get('show/{id}', [CatelogueController::class , 'show'])->name('show'); 
        Route::get('{id}/edit', [CatelogueController::class , 'edit'])->name('edit'); 
        Route::put('{id}/update', [CatelogueController::class , 'update'])->name('update'); 
        Route::delete('{id}/destroy', [CatelogueController::class , 'destroy'])->name('destroy');
    }) ;
     
    Route::resource('products', ProductController::class) ;
});
