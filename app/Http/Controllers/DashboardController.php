<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ActivityLog;
use App\Models\PermohonanLitigasi;
use App\Models\PermohonanNonLitigasi;
use App\Models\Lawyer;
use App\Models\Paralegal;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $isAdmin = $user?->role === 'admin';
        $isLawyer = $user?->role === 'pengacara';
        $isParalegal = $user?->role === 'paralegal';
        $isMember = $user?->role === 'user';

        $reportQuery = Report::query();
        if ($isMember) {
            $reportQuery->where('user_id', $user->id);
        }

        $totalReports = $reportQuery->count();
        $activeReports = (clone $reportQuery)->whereIn('status', ['In Progress', 'Submitted'])->count();

        $litigasisQuery = PermohonanLitigasi::query();
        $nonLitigasisQuery = PermohonanNonLitigasi::query();

        if ($isLawyer) {
            $lawyerId = $user->lawyer?->id;
            $lawyerId ? $litigasisQuery->where('assigned_lawyer_id', $lawyerId) : $litigasisQuery->whereRaw('1 = 0');
            $lawyerId ? $nonLitigasisQuery->where('assigned_lawyer_id', $lawyerId) : $nonLitigasisQuery->whereRaw('1 = 0');
        } elseif ($isParalegal) {
            $paralegalId = $user->paralegal?->id;
            $paralegalId ? $litigasisQuery->where('assigned_paralegal_id', $paralegalId) : $litigasisQuery->whereRaw('1 = 0');
            $paralegalId ? $nonLitigasisQuery->where('assigned_paralegal_id', $paralegalId) : $nonLitigasisQuery->whereRaw('1 = 0');
        } elseif ($isMember) {
            $litigasisQuery->where('user_id', $user->id);
            $nonLitigasisQuery->where('user_id', $user->id);
        }

        $totalLitigasi = $litigasisQuery->count();
        $totalNonLitigasi = $nonLitigasisQuery->count();
        $totalPermohonan = $totalLitigasi + $totalNonLitigasi;

        $permohonanByType = [
            (object) ['name' => 'Litigasi', 'count' => $totalLitigasi],
            (object) ['name' => 'Non-Litigasi', 'count' => $totalNonLitigasi]
        ];

        $dashboardCards = [];
        $quickLinks = [];
        
        // Quick Links - hanya untuk user biasa, tidak untuk advocate
        if (!$isLawyer && !$isParalegal) {
            $quickLinks = [
                ['href' => route('permohonan-litigasi.create'), 'icon' => 'fa-solid fa-scale-balanced', 'label' => 'Ajukan Litigasi', 'bg' => 'rgba(99,102,241,.12)', 'ic' => '#6366f1'],
                ['href' => route('permohonan-non-litigasi.create'), 'icon' => 'fa-solid fa-handshake', 'label' => 'Ajukan Non-Litigasi', 'bg' => 'rgba(16,185,129,.12)', 'ic' => '#10b981'],
            ];
        }

        if ($isAdmin) {
            $dashboardCards = [
                ['label' => 'Total Pengguna', 'val' => User::count(), 'icon' => 'fa-solid fa-users', 'g' => 'linear-gradient(135deg,#0ea5e9,#0284c7)', 'sub' => 'Akun terdaftar', 'href' => route('users.index')],
                ['label' => 'Total Advocate', 'val' => Lawyer::count(), 'icon' => 'fa-solid fa-gavel', 'g' => 'linear-gradient(135deg,#ec4899,#db2777)', 'sub' => 'Advocate terdaftar', 'href' => route('lawyers.index')],
                ['label' => 'Total Paralegal', 'val' => Paralegal::count(), 'icon' => 'fa-solid fa-user-shield', 'g' => 'linear-gradient(135deg,#10b981,#059669)', 'sub' => 'Paralegal terdaftar', 'href' => route('paralegals.index')],
                ['label' => 'Permohonan Litigasi', 'val' => $totalLitigasi, 'icon' => 'fa-solid fa-scale-balanced', 'g' => 'linear-gradient(135deg,#10b981,#059669)', 'sub' => 'Total permohonan litigasi', 'href' => route('permohonan-litigasi.index')],
                ['label' => 'Permohonan Non-Litigasi', 'val' => $totalNonLitigasi, 'icon' => 'fa-solid fa-handshake', 'g' => 'linear-gradient(135deg,#f97316,#ea580c)', 'sub' => 'Total permohonan non-litigasi', 'href' => route('permohonan-non-litigasi.index')],
            ];
            $quickLinks[] = ['href' => route('users.create'), 'icon' => 'fa-solid fa-user-plus', 'label' => 'Tambah User', 'bg' => 'rgba(14,165,233,.12)', 'ic' => '#0ea5e9'];
            $quickLinks[] = ['href' => route('lawyers.create'), 'icon' => 'fa-solid fa-person-circle-plus', 'label' => 'Tambah Advocate', 'bg' => 'rgba(236,72,153,.12)', 'ic' => '#ec4899'];
            $quickLinks[] = ['href' => route('paralegals.create'), 'icon' => 'fa-solid fa-user-shield', 'label' => 'Tambah Paralegal', 'bg' => 'rgba(16,185,129,.12)', 'ic' => '#10b981'];
            $statusSummary = [
                ['name' => 'Litigasi Terdaftar', 'count' => PermohonanLitigasi::where('status', PermohonanLitigasi::STATUS_REGISTERED)->count(), 'color' => '#6366f1'],
                ['name' => 'Litigasi Ditugaskan', 'count' => PermohonanLitigasi::where('status', PermohonanLitigasi::STATUS_ASSIGNED)->count(), 'color' => '#f59e0b'],
                ['name' => 'Non-Litigasi Terdaftar', 'count' => PermohonanNonLitigasi::where('status', PermohonanNonLitigasi::STATUS_REGISTERED)->count(), 'color' => '#10b981'],
                ['name' => 'Non-Litigasi Ditugaskan', 'count' => PermohonanNonLitigasi::where('status', PermohonanNonLitigasi::STATUS_ASSIGNED)->count(), 'color' => '#f97316'],
            ];
        } elseif ($isLawyer || $isParalegal) {
            $assignedLitigasi = (clone $litigasisQuery)->count();
            $assignedNonLitigasi = (clone $nonLitigasisQuery)->count();
            $assignmentColumn = $isLawyer ? 'assigned_lawyer_id' : 'assigned_paralegal_id';
            $assignmentId = $isLawyer ? $user->lawyer?->id : $user->paralegal?->id;
            $openTasks = $assignmentId
                ? PermohonanLitigasi::where($assignmentColumn, $assignmentId)
                    ->whereIn('status', [PermohonanLitigasi::STATUS_VERIFIED, PermohonanLitigasi::STATUS_ASSIGNED])->count()
                    + PermohonanNonLitigasi::where($assignmentColumn, $assignmentId)
                    ->whereIn('status', [PermohonanNonLitigasi::STATUS_VERIFIED, PermohonanNonLitigasi::STATUS_ASSIGNED])->count()
                : 0;

            $dashboardCards = [
                ['label' => 'Tugas Ditugaskan', 'val' => $openTasks, 'icon' => 'fa-solid fa-briefcase', 'g' => 'linear-gradient(135deg,#8b5cf6,#6366f1)', 'sub' => 'Kasus aktif milik Anda', 'href' => null],
                ['label' => 'Litigasi Ditugaskan', 'val' => $assignedLitigasi, 'icon' => 'fa-solid fa-scale-balanced', 'g' => 'linear-gradient(135deg,#10b981,#059669)', 'sub' => 'Permohonan litigasi', 'href' => route('permohonan-litigasi.index')],
                ['label' => 'Non-Litigasi Ditugaskan', 'val' => $assignedNonLitigasi, 'icon' => 'fa-solid fa-handshake', 'g' => 'linear-gradient(135deg,#f97316,#ea580c)', 'sub' => 'Permohonan non-litigasi', 'href' => route('permohonan-non-litigasi.index')],
                ['label' => 'Total Permohonan', 'val' => $totalPermohonan, 'icon' => 'fa-solid fa-file-lines', 'g' => 'linear-gradient(135deg,#0ea5e9,#0284c7)', 'sub' => 'Semua permohonan terkait', 'href' => null],
            ];

            $verifiedTasks = $assignmentId
                ? PermohonanLitigasi::where($assignmentColumn, $assignmentId)->where('status', PermohonanLitigasi::STATUS_VERIFIED)->count()
                    + PermohonanNonLitigasi::where($assignmentColumn, $assignmentId)->where('status', PermohonanNonLitigasi::STATUS_VERIFIED)->count()
                : 0;
            $assignedTasks = $assignmentId
                ? PermohonanLitigasi::where($assignmentColumn, $assignmentId)->where('status', PermohonanLitigasi::STATUS_ASSIGNED)->count()
                    + PermohonanNonLitigasi::where($assignmentColumn, $assignmentId)->where('status', PermohonanNonLitigasi::STATUS_ASSIGNED)->count()
                : 0;

            $statusSummary = [
                ['name' => 'Menunggu Verifikasi', 'count' => $verifiedTasks, 'color' => '#60a5fa'],
                ['name' => 'Sedang Dikerjakan', 'count' => $assignedTasks, 'color' => '#f59e0b'],
            ];
        } else {
            $completedRequests = PermohonanLitigasi::where('user_id', $user->id)->where('status', PermohonanLitigasi::STATUS_DONE)->count()
                + PermohonanNonLitigasi::where('user_id', $user->id)->where('status', PermohonanNonLitigasi::STATUS_DONE)->count();
            $pendingRequests = PermohonanLitigasi::where('user_id', $user->id)->whereIn('status', [PermohonanLitigasi::STATUS_REGISTERED, PermohonanLitigasi::STATUS_APPROVED, PermohonanLitigasi::STATUS_VERIFIED])->count()
                + PermohonanNonLitigasi::where('user_id', $user->id)->whereIn('status', [PermohonanNonLitigasi::STATUS_REGISTERED, PermohonanNonLitigasi::STATUS_APPROVED, PermohonanNonLitigasi::STATUS_VERIFIED])->count();

            $dashboardCards = [
                ['label' => 'Permohonan Litigasi', 'val' => $totalLitigasi, 'icon' => 'fa-solid fa-scale-balanced', 'g' => 'linear-gradient(135deg,#10b981,#059669)', 'sub' => 'Permohonan litigasi Anda', 'href' => route('permohonan-litigasi.index')],
                ['label' => 'Permohonan Non-Litigasi', 'val' => $totalNonLitigasi, 'icon' => 'fa-solid fa-handshake', 'g' => 'linear-gradient(135deg,#f97316,#ea580c)', 'sub' => 'Permohonan non-litigasi Anda', 'href' => route('permohonan-non-litigasi.index')],
                ['label' => 'Menunggu', 'val' => $pendingRequests, 'icon' => 'fa-solid fa-hourglass-half', 'g' => 'linear-gradient(135deg,#f59e0b,#d97706)', 'sub' => 'Permohonan belum selesai', 'href' => null],
                ['label' => 'Selesai', 'val' => $completedRequests, 'icon' => 'fa-solid fa-circle-check', 'g' => 'linear-gradient(135deg,#0ea5e9,#0284c7)', 'sub' => 'Permohonan yang selesai', 'href' => null],
            ];
        }

        $recentActivities = ActivityLog::with('user')->orderBy('created_at', 'desc')->take(8)->get();

        return view('dashboard', compact(
            'dashboardCards',
            'quickLinks',
            'permohonanByType',
            'recentActivities',
            'totalPermohonan',
            'isAdmin',
            'isLawyer',
            'isParalegal',
            'isMember'
        ));
    }
}
