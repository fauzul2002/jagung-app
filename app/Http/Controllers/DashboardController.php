<?php

namespace App\Http\Controllers;

use App\Models\Jagung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $dataPeriode = Jagung::select(
            'priode',
            DB::raw('SUM(totalProduktivitas) as totalProduktivitas'),
            DB::raw('SUM(totalProduksi) as totalProduksi'),
            DB::raw('SUM(areaPanen) as totalAreaPanen'),
            DB::raw('SUM(areaLahan) as totalAreaLahan')
        )
            ->groupBy('priode')
            ->get();
        return view('dashboard.index')->with(compact('title', 'dataPeriode'));
    }
}
