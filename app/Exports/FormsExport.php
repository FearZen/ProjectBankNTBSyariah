<?php

namespace App\Exports;

use App\Models\Form;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil semua data dari model Form dan menambahkan nomor urut
        $forms = Form::select(
            'requestor_name', 
            'company_name', 
            'address', 
            'phone_number', 
            'mobile_number', 
            'email', 
            'date_of_request', 
            'photo', 
            'country', 
            'data_center', 
            'data_center_address', 
            'visit_from_date', 
            'visit_from_time', 
            'visit_to_date', 
            'visit_to_time', 
            'visit_purpose', 
            'permit_to_work', 
            'rack_id'
        )->get();

        // Menambahkan nomor urut ke dalam setiap record
        $forms = $forms->map(function ($form, $key) {
            return [
                'No' => $key + 1, // Nomor urut
                'Nama Pemohon' => $form->requestor_name,
                'Nama Perusahaan' => $form->company_name,
                'Alamat' => $form->address,
                'Nomor Telepon' => $form->phone_number,
                'Nomor Ponsel' => $form->mobile_number,
                'Alamat E-Mail' => $form->email,
                'Tanggal Permohonan' => $form->date_of_request,
                'Foto' => $form->photo,
                'Negara' => $form->country,
                'Data Center' => $form->data_center,
                'Alamat Pusat Data' => $form->data_center_address,
                'Periode Kunjungan Dari (Tanggal)' => $form->visit_from_date,
                'Periode Kunjungan Dari (Waktu)' => $form->visit_from_time,
                'Periode Kunjungan Sampai (Tanggal)' => $form->visit_to_date,
                'Periode Kunjungan Sampai (Waktu)' => $form->visit_to_time,
                'Tujuan Kunjungan' => $form->visit_purpose,
                'Izin Bekerja?' => $form->permit_to_work ? 'Yes' : 'No',
                'Rack ID' => $form->rack_id,
            ];
        });

        return $forms;
    }

    public function headings(): array
    {
        return [
            'No', // Menambahkan header untuk nomor urut
            'Nama Pemohon', 
            'Nama Perusahaan', 
            'Alamat', 
            'Nomor Telepon', 
            'Nomor Ponsel', 
            'Alamat E-Mail', 
            'Tanggal Permohonan', 
            'Foto', 
            'Negara', 
            'Data Center', 
            'Alamat Pusat Data', 
            'Periode Kunjungan Dari (Tanggal)', 
            'Periode Kunjungan Dari (Waktu)', 
            'Periode Kunjungan Sampai (Tanggal)', 
            'Periode Kunjungan Sampai (Waktu)', 
            'Tujuan Kunjungan', 
            'Izin Bekerja?', 
            'Rack ID'
        ];
    }
}
