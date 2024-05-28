<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filterResults(Request $request)
    {
        $query = DB::table('Kandidaat')->orderByDesc('Pinned');

        if ($request->filled('functie')) {
            $query->where('Functie', $request->input('functie'));
        }

        if ($request->filled('beschikbaarheid')) {
            $query->where('Beschikbaar', $request->input('beschikbaarheid'));
        }

        if (!auth()->check()) {
            $query->where('Beschikbaar', 1);
        }

        // Paginate the results
        $kandidaten = $query->paginate(12)->appends($request->except('page'));

        return view('overzicht', ['kandidaten' => $kandidaten]);
    }
}
