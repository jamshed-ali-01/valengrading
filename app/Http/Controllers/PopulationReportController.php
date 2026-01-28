<?php

namespace App\Http\Controllers;

use App\Models\PopulationReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulationReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = PopulationReport::query()
            ->selectRaw('
                year,
                title,
                brand,
                set_name,
                card_number,
                rarity,
                SUM(grade_1) as grade_1,
                SUM(grade_2) as grade_2,
                SUM(grade_3) as grade_3,
                SUM(grade_4) as grade_4,
                SUM(grade_5) as grade_5,
                SUM(grade_6) as grade_6,
                SUM(grade_7) as grade_7,
                SUM(grade_8) as grade_8,
                SUM(grade_9) as grade_9,
                SUM(grade_10) as grade_10,
                SUM(total) as total_graded
            ');
            
        if ($search) {
             $query->where(function($q) use ($search) {
                 $q->where('title', 'like', "%{$search}%")
                   ->orWhere('set_name', 'like', "%{$search}%")
                   ->orWhere('card_number', 'like', "%{$search}%");
             });
        }

        $reports = $query->groupBy('year', 'title', 'brand', 'set_name', 'card_number', 'rarity')
            ->orderBy('year', 'desc')
            ->orderBy('title', 'asc')
            ->paginate(20);

        return view('frontend.pop-report', compact('reports'));
    }
}
