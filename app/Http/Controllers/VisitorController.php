<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
{
    $query = Visitor::query();

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where('visitor_name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('visitor_company_name', 'LIKE', "%{$searchTerm}%");
    }

    $visitors = $query->paginate(10); // 10 pengunjung per halaman
    return view('visitors.index', compact('visitors'));
}
public function edit(Visitor $visitor)
{
    return view('visitors.edit', compact('visitor'));
}

public function update(Request $request, Visitor $visitor)
{
    $request->validate([
        'visitor_name' => 'required',
        'visitor_company_name' => 'required',
        'visitor_email' => 'required|email',
        'visitor_phone_number' => 'nullable',
        'vehicle_number' => 'nullable',
    ]);

    $visitor->update($request->all());

    return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil diperbarui.');
}

public function destroy(Visitor $visitor)
{
    $visitor->delete();
    return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil dihapus.');
}



}
