<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'requestor_name', 'company_name', 'address', 'phone_number', 'mobile_number',
        'email', 'date_of_request', 'country', 'data_center', 'data_center_address',
        'visit_from_date', 'visit_from_time', 'visit_to_date', 'visit_to_time',
        'visit_purpose', 'permit_to_work', 'rack_id', 'photo'
    ];
    
}