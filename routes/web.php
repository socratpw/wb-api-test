<?php

use App\Http\Controllers\WbController;
use Illuminate\Support\Facades\Route;

// Главная страница — показывает кнопки
Route::get('/', [WbController::class, 'index']);

// Загрузить данные с API и сохранить в БД
Route::post('/send-data', [WbController::class, 'sendData']);
