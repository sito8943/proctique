<?php

use App\Http\Controllers\Api\AuthorApiController;
use App\Http\Controllers\Api\ProjectApiController;
use App\Http\Controllers\Api\TagApiController;
use App\Http\Controllers\Api\MollieWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('mollie/webhook', MollieWebhookController::class)->name('api.mollie.webhook');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('projects', [ProjectApiController::class, 'index'])->name('api.projects.index');
    Route::get('projects/{id}', [ProjectApiController::class, 'show'])->name('api.projects.show');

    Route::get('authors/', [AuthorApiController::class, 'index'])->name('api.authors.index');
    Route::get('authors/{id}', [AuthorApiController::class, 'show'])->name('api.authors.show');

    Route::get('tags', [TagApiController::class, 'index'])->name('api.tags.index');
    Route::get('tags/{id}', [TagApiController::class, 'show'])->name('api.tags.show');
});