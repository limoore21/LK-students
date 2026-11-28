<?php

use App\Http\Controllers\SurveyAndSuggestion\SurveyAndSuggestionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('suggestions', [SurveyAndSuggestionController::class, 'index'])
        ->name('suggestions');
});