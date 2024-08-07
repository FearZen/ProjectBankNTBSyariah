<?php

// App\Models\Visitor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'access_form_id',
        'visitor_name',
        'visitor_type',
        'visitor_designation',
        'visitor_company_name',
        'identity_number',
        'visitor_phone_number',
        'visitor_email',
        'vehicle_number',
    ];
    public function accessForm()
    {
        return $this->belongsTo(AccessForm::class);
    }
}
