<?php

use App\Http\Controllers\InstrukturController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('instruktur.index'));
Route::resource('instruktur', InstrukturController::class)->except('show');