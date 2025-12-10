<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Preview de componentes (apenas para desenvolvimento)
Route::get('/components-preview', function () {
    return view('components-preview');
})->name('components.preview');

// Rotas placeholder (serão implementadas depois)
Route::get('/', function () {
    return redirect()->route('components.preview');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/portfolio', function () {
    return redirect()->route('components.preview');
})->name('portfolio');

Route::get('/carteiras', function () {
    return view('carteiras');
})->name('carteiras');

Route::get('/operacoes', function () {
    return redirect()->route('components.preview');
})->name('operacoes');

Route::get('/declaracoes', function () {
    return redirect()->route('components.preview');
})->name('declaracoes');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // TODO: Implementar autenticacao
    return redirect()->route('dashboard');
})->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // TODO: Implementar cadastro
    return redirect()->route('login');
})->name('register.post');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Social Login placeholder
Route::get('/login/google', function () {
    // TODO: Implementar login com Google
    return redirect()->route('login');
})->name('login.google');

// Onboarding Routes
Route::get('/onboarding', function () {
    return view('onboarding.welcome');
})->name('onboarding.welcome');

Route::get('/onboarding/select-platform', function () {
    return view('onboarding.select-platform');
})->name('onboarding.select-platform');

Route::get('/onboarding/connect/{exchange}', function ($exchange) {
    return view('onboarding.connect-exchange', ['exchange' => $exchange]);
})->name('onboarding.connect-exchange');

Route::get('/onboarding/import-automatic/{exchange}', function ($exchange) {
    return view('onboarding.import-automatic', ['exchange' => $exchange]);
})->name('onboarding.import-automatic');

Route::get('/onboarding/import-manual/{exchange}', function ($exchange) {
    return view('onboarding.import-manual', ['exchange' => $exchange]);
})->name('onboarding.import-manual');

Route::get('/onboarding/processing/{exchange?}', function ($exchange = null) {
    return view('onboarding.processing', ['exchange' => $exchange]);
})->name('onboarding.processing');
