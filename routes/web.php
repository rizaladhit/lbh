<?php

use App\Http\Controllers\ProfileController;
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

Route::redirect('/', '/dashboard');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/trial-limit', function () {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('dashboard');
        }

        return view('trial-limit', [
            'trialCount' => $user->trial_count,
            'limit' => intval(config('trial.limit')),
        ]);
    })->name('trial.limit');
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\JenisPelayananController;
use App\Http\Controllers\LawyerController;

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('lawyers', LawyerController::class);
    Route::get('settings', [AppSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [AppSettingController::class, 'update'])->name('settings.update');
    Route::resource('jenis-pelayanan', JenisPelayananController::class)->only(['store', 'destroy']);
});

use App\Http\Controllers\ReportController;
use App\Http\Controllers\DraftingDokumenHukumReportController;
use App\Http\Controllers\MediasiReportController;
use App\Http\Controllers\ReimbursementReportController;
use App\Http\Controllers\NegosiasiReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
    Route::get('reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    Route::resource('reports', ReportController::class);
    Route::resource('drafting-reports', DraftingDokumenHukumReportController::class)->parameters([
        'drafting-reports' => 'draftingReport'
    ]);
    Route::resource('mediasi-reports', MediasiReportController::class)->parameters([
        'mediasi-reports' => 'mediasiReport'
    ]);
    Route::resource('reimbursement-reports', ReimbursementReportController::class)->parameters([
        'reimbursement-reports' => 'reimbursementReport'
    ]);
    Route::get('reimbursement-reports/create/pemberdayaan-masyarakat', [ReimbursementReportController::class, 'createPemberdayaan'])->name('reimbursement-reports.create-pemberdayaan');
    Route::resource('negosiasi-reports', NegosiasiReportController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
});

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PermohonanLitigasiController;
use App\Http\Controllers\PermohonanNonLitigasiController;

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('permohonan-litigasi', PermohonanLitigasiController::class)
        ->parameters(['permohonan-litigasi' => 'permohonanLitigasi'])
        ->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::get('permohonan-litigasi/{permohonanLitigasi}/print', [PermohonanLitigasiController::class, 'printForm'])
        ->name('permohonan-litigasi.print');
    
    // Workflow routes for permohonan litigasi
    Route::get('permohonan-litigasi/{permohonanLitigasi}/approve', [PermohonanLitigasiController::class, 'approve'])
        ->name('permohonan-litigasi.approve');
    Route::post('permohonan-litigasi/{permohonanLitigasi}/approve', [PermohonanLitigasiController::class, 'storeApprove'])
        ->name('permohonan-litigasi.storeApprove');
    Route::get('permohonan-litigasi/{permohonanLitigasi}/reject', [PermohonanLitigasiController::class, 'reject'])
        ->name('permohonan-litigasi.reject');
    Route::post('permohonan-litigasi/{permohonanLitigasi}/reject', [PermohonanLitigasiController::class, 'storeReject'])
        ->name('permohonan-litigasi.storeReject');
    Route::get('permohonan-litigasi/{permohonanLitigasi}/verify', [PermohonanLitigasiController::class, 'verify'])
        ->name('permohonan-litigasi.verify');
    Route::post('permohonan-litigasi/{permohonanLitigasi}/verify', [PermohonanLitigasiController::class, 'storeVerify'])
        ->name('permohonan-litigasi.storeVerify');
    Route::get('permohonan-litigasi/{permohonanLitigasi}/edit', [PermohonanLitigasiController::class, 'edit'])
        ->name('permohonan-litigasi.edit');
    Route::put('permohonan-litigasi/{permohonanLitigasi}', [PermohonanLitigasiController::class, 'update'])
        ->name('permohonan-litigasi.update');
    Route::get('permohonan-litigasi/{permohonanLitigasi}/assign', [PermohonanLitigasiController::class, 'assignForm'])
        ->name('permohonan-litigasi.assignForm');
    Route::post('permohonan-litigasi/{permohonanLitigasi}/assign', [PermohonanLitigasiController::class, 'storeAssign'])
        ->name('permohonan-litigasi.storeAssign');
    Route::get('permohonan-litigasi/{permohonanLitigasi}/complete', [PermohonanLitigasiController::class, 'completeForm'])
        ->name('permohonan-litigasi.completeForm');
    Route::post('permohonan-litigasi/{permohonanLitigasi}/complete', [PermohonanLitigasiController::class, 'storeComplete'])
        ->name('permohonan-litigasi.storeComplete');

    Route::resource('permohonan-non-litigasi', PermohonanNonLitigasiController::class)
        ->parameters(['permohonan-non-litigasi' => 'permohonanNonLitigasi'])
        ->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/print', [PermohonanNonLitigasiController::class, 'printForm'])
        ->name('permohonan-non-litigasi.print');

    // Workflow routes for permohonan non-litigasi
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/approve', [PermohonanNonLitigasiController::class, 'approve'])
        ->name('permohonan-non-litigasi.approve');
    Route::post('permohonan-non-litigasi/{permohonanNonLitigasi}/approve', [PermohonanNonLitigasiController::class, 'storeApprove'])
        ->name('permohonan-non-litigasi.storeApprove');
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/reject', [PermohonanNonLitigasiController::class, 'reject'])
        ->name('permohonan-non-litigasi.reject');
    Route::post('permohonan-non-litigasi/{permohonanNonLitigasi}/reject', [PermohonanNonLitigasiController::class, 'storeReject'])
        ->name('permohonan-non-litigasi.storeReject');
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/verify', [PermohonanNonLitigasiController::class, 'verify'])
        ->name('permohonan-non-litigasi.verify');
    Route::post('permohonan-non-litigasi/{permohonanNonLitigasi}/verify', [PermohonanNonLitigasiController::class, 'storeVerify'])
        ->name('permohonan-non-litigasi.storeVerify');
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/edit', [PermohonanNonLitigasiController::class, 'edit'])
        ->name('permohonan-non-litigasi.edit');
    Route::put('permohonan-non-litigasi/{permohonanNonLitigasi}', [PermohonanNonLitigasiController::class, 'update'])
        ->name('permohonan-non-litigasi.update');
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/assign', [PermohonanNonLitigasiController::class, 'assignForm'])
        ->name('permohonan-non-litigasi.assignForm');
    Route::post('permohonan-non-litigasi/{permohonanNonLitigasi}/assign', [PermohonanNonLitigasiController::class, 'storeAssign'])
        ->name('permohonan-non-litigasi.storeAssign');
    Route::get('permohonan-non-litigasi/{permohonanNonLitigasi}/complete', [PermohonanNonLitigasiController::class, 'completeForm'])
        ->name('permohonan-non-litigasi.completeForm');
    Route::post('permohonan-non-litigasi/{permohonanNonLitigasi}/complete', [PermohonanNonLitigasiController::class, 'storeComplete'])
        ->name('permohonan-non-litigasi.storeComplete');
});

require __DIR__.'/auth.php';
