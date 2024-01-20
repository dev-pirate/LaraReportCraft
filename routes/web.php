<?php

use DevPirate\LaraReportCraft\Controllers\ReportFetchController;
use DevPirate\LaraReportCraft\Controllers\ReportGeneratorController;
use DevPirate\LaraReportCraft\Controllers\ReportPrintController;
use DevPirate\LaraReportCraft\Controllers\ReportSaveController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lara-report-craft'], function () {
    Route::post('report-list', ReportFetchController::class)->name('lara_report_craft.reports_fetch');
    Route::post('print', ReportPrintController::class)->name('lara_report_craft.reports_printing');
    Route::post('report-generate', ReportGeneratorController::class)->name('lara_report_craft.reports_generate');
    Route::post('report-save', ReportSaveController::class)->name('lara_report_craft.report_save');
});

