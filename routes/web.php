<?php

use App\Http\Controllers\Api\NoteApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AddContextMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('benchmark', function (){
    dd(Auth::user());
    return \Illuminate\Support\Benchmark::measure(
        [
            fn() => \App\Models\Note::all()
        ]
    );

});

//enum casting
Route::get('product-store', [ProductController::class, 'index']);
Route::get('product-get', [ProductController::class, 'show'])
        ->middleware(AddContextMiddleware::class);//Context




Route::redirect('/', '/note')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    // Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    // Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    // Route::get('/note/{id}', [NoteController::class, 'show'])->name('note.show');
    // Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('note.edit');
    // Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
    // Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');

    Route::resource('note', NoteController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__ . '/auth.php';

Route::get('api/note', [NoteApiController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/messages', [HomeController::class, 'messages'])
    ->name('messages');
Route::post('/message', [HomeController::class, 'message'])
    ->name('message');

//new in laravel
Route::get('fluent/helper', [\App\Http\Controllers\NewInLaravelController::class,'helperFluent']);
Route::get('collection/select/update', [\App\Http\Controllers\NewInLaravelController::class,'collectionSelectUpdate']);
Route::get('lateral/join', [\App\Http\Controllers\NewInLaravelController::class,'lateralJoin']);
Route::get('collect/select', [\App\Http\Controllers\NewInLaravelController::class,'collectSelect']);


//tips
Route::get('model/increment/method', [\App\Http\Controllers\TipsController::class,'incrementMethodModel']);
Route::get('model/findOrFail', [\App\Http\Controllers\TipsController::class,'findOrFail']);
Route::get('model/firstOrCreate', [\App\Http\Controllers\TipsController::class,'firstOrCreate']);
Route::get('model/relationship/with/conditions', [\App\Http\Controllers\TipsController::class,'relationshipWithConditions']);
Route::get('model/where/x', [\App\Http\Controllers\TipsController::class,'whereX']);
Route::get('model/when', [\App\Http\Controllers\TipsController::class,'when']);
Route::get('model/withDefault', [\App\Http\Controllers\TipsController::class,'withDefault']);
