<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessForm;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AccessFormController extends Controller
{
    public function create()
{
    return view('forms.create');
}

    // Menampilkan data formulir
    public function index()
{
    $forms = AccessForm::with('visitors')->get(); // Pastikan data pengunjung juga diambil
    return view('access_forms.index', compact('forms'));
}
        
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
                'purpose_of_visit' => 'required|string',
                'number_of_visitors' => 'required|integer',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto
            ]);
        
            // Proses upload foto jika ada
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $validatedData['photo'] = $photoPath;
            }
        
            // Simpan data ke database
            $form = AccessForm::create($validatedData);
        
            // Simpan data pengunjung
            for ($i = 1; $i <= $validatedData['number_of_visitors']; $i++) {
                if ($request->has("visitor_name_$i")) {
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
        
            // Redirect dengan pesan sukses
            return redirect()->route('access_forms.index')->with('success', 'Formulir berhasil disimpan!');
        }
    }        