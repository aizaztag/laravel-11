<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', \App\Livewire\Welcome::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Volt::route('/posts', 'pages.posts.create-post')
   // ->middleware('auth')
    ->name('posts.index');

require __DIR__.'/auth.php';
