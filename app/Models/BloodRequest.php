<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model
{
    protected $fillable = [
        'user_id',
        'patient_name',
        'blood_group',
        'units',
        'hospital_name',
        'hospital_address',
        'city',
        'contact_person',
        'contact_phone',
        'urgency',
        'is_approved',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
            'units' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
