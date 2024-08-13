<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // CompanyController.php

public function create()
{
    return view('companies.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Company::create([
        'name' => $request->name,
    ]);

    return redirect()->route('companies.create')->with('success', 'Perusahaan berhasil ditambahkan.');
}

}
