<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessForm;
use App\Models\Visitor;
use App\Models\Company; // Tambahkan ini
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AccessFormController extends Controller
{
    // Metode create untuk menampilkan formulir
    public function create()
{
    $companies = Company::all(); // Mengambil semua perusahaan dari database
    return view('forms.create', compact('companies')); // Perbarui path view
}



    // Metode untuk mendapatkan data pengunjung berdasarkan form ID
    public function getVisitors($formId)
    {
        $form = AccessForm::with('visitors')->find($formId);
        if ($form) {
            return response()->json(['visitors' => $form->visitors]);
        } else {
            return response()->json(['error' => 'Form not found'], 404);
        }
    }

    // Menampilkan daftar formulir
    public function index()
    {
        $forms = AccessForm::with('visitors')->get(); // Pastikan data pengunjung juga diambil
        return view('access_forms.index', compact('forms'));
    }

    // Menyimpan data formulir ke database
    public function store(Request $request)
{
    // Validasi data
    $validatedData = $request->validate([
        'requestor_name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'address' => 'required|string',
        'phone_number' => 'required|string',
        'mobile_number' => 'required|string',
        'email' => 'required|email',
        'date_of_request' => 'required|date',
        'country' => 'required|string',
        'data_center' => 'required|string',
        'data_center_address' => 'required|string',
        'visit_from_date' => 'required|date',
        'visit_from_time' => 'required|date_format:H:i',
        'visit_to_date' => 'required|date',
        'visit_to_time' => 'required|date_format:H:i',
        'visit_purpose' => 'required|string|max:255',
        'permit_to_work' => 'required|string',
        'rack_id' => 'required|string|max:255',
        'number_of_visitors' => 'nullable|integer',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
    ]);

    // Proses upload foto jika ada
    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $photoBase64 = base64_encode(file_get_contents($photo->getRealPath()));
        $validatedData['photo'] = $photoBase64;
    }

    // Simpan data ke database
    $form = AccessForm::create($validatedData);

    // Simpan data pengunjung jika ada
    if ($validatedData['number_of_visitors'] && $validatedData['number_of_visitors'] > 0) {
        for ($i = 1; $i <= $validatedData['number_of_visitors']; $i++) {
            if ($request->filled("visitor_name_$i")) {
                $form->visitors()->create([
                    'visitor_name' => $request->input("visitor_name_$i"),
                    'visitor_type' => $request->input("visitor_type_$i"),
                    'visitor_designation' => $request->input("visitor_designation_$i"),
                    'visitor_company_name' => $request->input("visitor_company_$i"),
                    'identity_number' => $request->input("visitor_id_$i"),
                    'visitor_phone_number' => $request->input("visitor_phone_$i"),
                    'visitor_email' => $request->input("visitor_email_$i"),
                    'vehicle_number' => $request->input("visitor_vehicle_$i"),
                ]);
            }
        }
    }

    // Redirect dengan pesan sukses
    return redirect()->route('access_forms.index')->with('success', 'Formulir berhasil disimpan!');
}
}
