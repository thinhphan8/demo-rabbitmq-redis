<?php

use App\Http\Controllers\RedisController;
use App\Http\Controllers\TestController;

Route::post("/message", function (Request $request) {
    $message = $_POST['message'];
    $mqService = new \App\Services\RabbitMQService();
    $mqService->publish($message);
    return view('welcome');
});


Route::get('/redis', [RedisController::class, 'index']);
Route::post('/test', [TestController::class, 'AcademicoRegisterApiTesting']);

