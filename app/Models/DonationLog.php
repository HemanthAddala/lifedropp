<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationLog extends Model
{
    protected $fillable = [
        'user_id',
        'donation_date',
        'location',
        'units',
    ];

    protected function casts(): array
    {
        return [
            'donation_date' => 'date',
            'units' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
