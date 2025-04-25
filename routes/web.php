<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'check.user.role'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/generate-pdf', 'generatePDF')->name('generate-pdf');
        Route::post('/send-report-emails', 'sendReportEmails')->name('send-report-emails');
    });

    Route::resource('candidate', CandidateController::class)->except(['create', 'show']);
    Route::resource('voters', VotersController::class)->except(['create', 'show', 'destroy']);
    Route::get('/voters/export/excel', [VotersController::class, 'exportExcel'])->name('voters.export.excel');
    Route::get('/voters/export/pdf', [VotersController::class, 'exportPdf'])->name('voters.export.pdf');
    Route::post('/voters/import/excel', [VotersController::class, 'importExcel'])->name('voters.import.excel');
    Route::post('/voters/mass-delete', [VotersController::class, 'massDelete'])->name('voters.massDelete');
    Route::resource('admin', AdminController::class)->except(['create', 'show']);

    Route::prefix('voter')->name('voter.')->controller(VoterController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/result', 'result')->name('result');
    });
});
