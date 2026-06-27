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
use App\Http\Controllers\LaporanPHController;
use App\Http\Controllers\ParalegalController;

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('lawyers', LawyerController::class);
    Route::resource('paralegals', ParalegalController::class);
    Route::get('settings', [AppSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [AppSettingController::class, 'update'])->name('settings.update');
    Route::resource('jenis-pelayanan', JenisPelayananController::class)->only(['store', 'destroy']);

    // Laporan Penasehat Hukum (PH) - Admin only
    Route::get('laporan-ph/pengadilan', [LaporanPHController::class, 'indexPengadilan'])->name('laporan-ph.pengadilan.index');
    Route::get('laporan-ph/pengadilan/print', [LaporanPHController::class, 'printPengadilan'])->name('laporan-ph.pengadilan.print');
    Route::get('laporan-ph/pengadilan/create', [LaporanPHController::class, 'createPengadilan'])->name('laporan-ph.pengadilan.create');
    Route::post('laporan-ph/pengadilan', [LaporanPHController::class, 'storePengadilan'])->name('laporan-ph.pengadilan.store');
    Route::get('laporan-ph/pengadilan/{laporanPH}/edit', [LaporanPHController::class, 'editPengadilan'])->name('laporan-ph.pengadilan.edit');
    Route::put('laporan-ph/pengadilan/{laporanPH}', [LaporanPHController::class, 'updatePengadilan'])->name('laporan-ph.pengadilan.update');
    Route::delete('laporan-ph/pengadilan/{laporanPH}', [LaporanPHController::class, 'destroyPengadilan'])->name('laporan-ph.pengadilan.destroy');
    Route::get('laporan-ph/lapas', [LaporanPHController::class, 'indexLapas'])->name('laporan-ph.lapas.index');
    Route::get('laporan-ph/lapas/print', [LaporanPHController::class, 'printLapas'])->name('laporan-ph.lapas.print');
    Route::get('laporan-ph/lapas/create', [LaporanPHController::class, 'createLapas'])->name('laporan-ph.lapas.create');
    Route::post('laporan-ph/lapas', [LaporanPHController::class, 'storeLapas'])->name('laporan-ph.lapas.store');
    Route::get('laporan-ph/lapas/{laporanPH}/edit', [LaporanPHController::class, 'editLapas'])->name('laporan-ph.lapas.edit');
    Route::put('laporan-ph/lapas/{laporanPH}', [LaporanPHController::class, 'updateLapas'])->name('laporan-ph.lapas.update');
    Route::delete('laporan-ph/lapas/{laporanPH}', [LaporanPHController::class, 'destroyLapas'])->name('laporan-ph.lapas.destroy');
    // Lookup litigasi by registration number (for autofill)
    Route::get('laporan-ph/lookup-litigasi', [LaporanPHController::class, 'lookupLitigasi'])->name('litigasi.lookup');

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
    Route::get('pemberdayaan-masyarakat', [ReimbursementReportController::class, 'indexPemberdayaan'])->name('pemberdayaan-masyarakat.index');
    Route::get('pemberdayaan-masyarakat/create', [ReimbursementReportController::class, 'createPemberdayaan'])->name('reimbursement-reports.create-pemberdayaan');
    Route::get('pemberdayaan-masyarakat/{reimbursementReport}', [ReimbursementReportController::class, 'showPemberdayaan'])->name('pemberdayaan-masyarakat.show');
    Route::resource('negosiasi-reports', NegosiasiReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update']);
    Route::resource('pendampingan-reports', \App\Http\Controllers\PendampinganReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'pendampingan-reports' => 'pendampinganReport'
    ]);
    Route::resource('penelitian-hukum-reports', \App\Http\Controllers\PenelitianHukumReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'penelitian-hukum-reports' => 'penelitianHukumReport'
    ]);
    Route::resource('penyuluhan-hukum-reports', \App\Http\Controllers\PenyuluhanHukumReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'penyuluhan-hukum-reports' => 'penyuluhanHukumReport'
    ]);
    Route::resource('perdata-reports', \App\Http\Controllers\PerdataReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'perdata-reports' => 'perdataReport'
    ]);
    Route::resource('pidana-reports', \App\Http\Controllers\PidanaReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'pidana-reports' => 'pidanaReport'
    ]);
    Route::resource('tun-reports', \App\Http\Controllers\TunReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'tun-reports' => 'tunReport'
    ]);
    Route::resource('konsultasi-hukum-reports', \App\Http\Controllers\KonsultasiHukumReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'konsultasi-hukum-reports' => 'konsultasiHukumReport'
    ]);
    Route::resource('investigasi-kasus-reports', \App\Http\Controllers\InvestigasiKasusReportController::class)->only(['index', 'create', 'store', 'show', 'destroy', 'edit', 'update'])->parameters([
        'investigasi-kasus-reports' => 'investigasiKasusReport'
    ]);
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
