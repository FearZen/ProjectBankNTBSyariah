<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessForm extends Model
{
    use HasFactory;

    protected $table = 'access_forms'; // Pastikan nama tabel sesuai
    protected $fillable = [
        'requestor_name', 'company_name', 'address', 'phone_number', 'mobile_number', 'email',
        'date_of_request', 'country', 'data_center', 'data_center_address', 'visit_from_date',
        'visit_from_time', 'visit_to_date', 'visit_to_time', 'visit_purpose', 'permit_to_work',
        'rack_id', 'photo', 'number_of_visitors'
    ];

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }
}
