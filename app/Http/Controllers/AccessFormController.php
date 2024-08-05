<?php

namespace App\Http\Controllers;

use App\Models\AccessForm;
use Illuminate\Http\Request;

class AccessFormController extends Controller
{
    // Metode untuk menampilkan daftar formulir
    public function index()
    {
        $forms = AccessForm::all(); // Mengambil semua data formulir
        return view('access_forms.index', compact('forms')); // Menampilkan tampilan dengan data
    }

    // Metode untuk menyimpan data formulir
    public function store(Request $request)
    {
        $request->validate([
            'requestor_name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'mobile_number' => 'required|string',
            'email' => 'required|email',
            'date_of_request' => 'required|date',
            'country' => 'nullable|string',
            'data_center' => 'nullable|string',
            'data_center_address' => 'nullable|string',
            'visit_from_date' => 'nullable|date',
            'visit_from_time' => 'nullable|date_format:H:i',
            'visit_to_date' => 'nullable|date',
            'visit_to_time' => 'nullable|date_format:H:i',
            'visit_purpose' => 'nullable|string',
            'permit_to_work' => 'nullable|boolean',
            'rack_id' => 'nullable|string',
            'photo' => 'nullable|image'
        ]);
    
        $form = new AccessForm();
        $form->requestor_name = $request->input('requestor_name');
        $form->company_name = $request->input('company_name');
        $form->address = $request->input('address');
        $form->phone_number = $request->input('phone_number');
        $form->mobile_number = $request->input('mobile_number');
        $form->email = $request->input('email');
        $form->date_of_request = $request->input('date_of_request');
        $form->country = $request->input('country');
        $form->data_center = $request->input('data_center');
        $form->data_center_address = $request->input('data_center_address');
        $form->visit_from_date = $request->input('visit_from_date');
        $form->visit_from_time = $request->input('visit_from_time');
        $form->visit_to_date = $request->input('visit_to_date');
        $form->visit_to_time = $request->input('visit_to_time');
        $form->visit_purpose = $request->input('visit_purpose');
        $form->permit_to_work = $request->input('permit_to_work') ? true : false;
        $form->rack_id = $request->input('rack_id');
    
        if ($request->hasFile('photo')) {
            $form->photo = $request->file('photo')->store('photos', 'public');
        }
    
        $form->save();

        // Debugging purposes
        \Log::info('Form data', $form->toArray());
    
        return redirect()->route('access_forms.index')->with('success', 'Form successfully created');
    }
}
