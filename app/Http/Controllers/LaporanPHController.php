<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPH;
use App\Models\PermohonanLitigasi;

class LaporanPHController extends Controller
{
    private function filteredReportsQuery(Request $request, string $type)
    {
        $query = LaporanPH::where('type', $type);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        return $query;
    }

    public function createPengadilan()
    {
        return view('reports.ph.pengadilan');
    }

    public function indexPengadilan(Request $request)
    {
        $type = 'pengadilan';
        $reports = $this->filteredReportsQuery($request, $type)
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('reports.ph.index', compact('reports', 'type'));
    }

    public function indexLapas(Request $request)
    {
        $type = 'lapas';
        $reports = $this->filteredReportsQuery($request, $type)
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('reports.ph.index', compact('reports', 'type'));
    }

    public function printPengadilan(Request $request)
    {
        return $this->printByType($request, 'pengadilan');
    }

    public function printLapas(Request $request)
    {
        return $this->printByType($request, 'lapas');
    }

    private function printByType(Request $request, string $type)
    {
        $reports = $this->filteredReportsQuery($request, $type)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reports.ph.print', compact('reports', 'type'));
    }

    public function storePengadilan(Request $request)
    {
        $data = $request->validate([
            'no_registrasi_perkara' => 'required|string',
            'nama' => 'required|string',
            'terdakwa' => 'nullable|string',
            'nama_jaksa' => 'nullable|string',
            'nama_penasehat_hukum' => 'nullable|string',
            'jenis_perkara' => 'nullable|string',
        ]);
        $data['type'] = 'pengadilan';
        LaporanPH::create($data);
        return redirect()->route('laporan-ph.pengadilan.create')->with('success', 'Laporan Pengadilan berhasil disimpan.');
    }

    public function createLapas()
    {
        return view('reports.ph.lapas');
    }

    public function storeLapas(Request $request)
    {
        $data = $request->validate([
            'no_registrasi_perkara' => 'required|string',
            'nama' => 'required|string',
            'terdakwa' => 'nullable|string',
            'nama_jaksa' => 'nullable|string',
            'nama_penasehat_hukum' => 'nullable|string',
            'jenis_perkara' => 'nullable|string',
        ]);
        $data['type'] = 'lapas';
        LaporanPH::create($data);
        return redirect()->route('laporan-ph.lapas.create')->with('success', 'Laporan Lapas berhasil disimpan.');
    }

    public function lookupLitigasi(Request $request)
    {
        if ($request->filled('q')) {
            $keyword = $request->query('q');

            return PermohonanLitigasi::query()
                ->where(function ($query) use ($keyword) {
                    $query->where('no_registrasi', 'like', "%{$keyword}%")
                        ->orWhere('nama', 'like', "%{$keyword}%")
                        ->orWhere('jenis_perkara', 'like', "%{$keyword}%");
                })
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(['no_registrasi', 'nama', 'jenis_perkara'])
                ->map(fn ($item) => [
                    'no_registrasi' => $item->no_registrasi,
                    'nama' => $item->nama,
                    'jenis_perkara' => $item->jenis_perkara,
                    'label' => "{$item->no_registrasi} - {$item->nama} ({$item->jenis_perkara})",
                ]);
        }

        $no = $request->query('no_registrasi');
        if (! $no) {
            return response()->json(null, 400);
        }
        $p = PermohonanLitigasi::where('no_registrasi', $no)->first();
        if (! $p) {
            return response()->json(null, 404);
        }
        return response()->json([
            'nama' => $p->nama,
            'terdakwa' => $p->nama,
            'jenis_perkara' => $p->jenis_perkara,
        ]);
    }
}
