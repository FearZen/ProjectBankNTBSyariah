<?php

namespace App\Http\Controllers;

use App\Models\AccessForm;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalForms = AccessForm::count();
        $totalVisitors = Visitor::count();
        $recentForms = AccessForm::orderBy('created_at', 'desc')->take(5)->get();

        // Data untuk grafik
        $visitorData = DB::table('visitors')
            ->select(DB::raw('date_trunc(\'day\', created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        $monthlyFormsData = DB::table('access_forms')
            ->select(DB::raw('date_trunc(\'month\', created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Format untuk grafik
        $visitorLabels = $visitorData->keys()->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });
        $visitorData = $visitorData->values();
        
        $monthLabels = range(1, 12); // Bulan 1-12
        $monthlyFormsData = $monthlyFormsData->mapWithKeys(function ($count, $month) {
            return [date('n', strtotime($month)) => $count];
        })->values()->concat(array_fill(0, 12 - $monthlyFormsData->count(), 0));

        return view('dashboard.index', compact('totalForms', 'totalVisitors', 'recentForms', 'visitorLabels', 'visitorData', 'monthLabels', 'monthlyFormsData'));
    }
}
