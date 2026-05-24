<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'city',
        'blood_group',
        'avatar',
        'is_available',
        'role',
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dob' => 'date',
            'is_available' => 'boolean',
            'is_verified' => 'boolean',
        ];
    }

    /**
     * Relationship with donation logs.
     */
    public function donationLogs()
    {
        return $this->hasMany(DonationLog::class)->orderBy('donation_date', 'desc');
    }

    /**
     * Relationship with blood requests created by this user.
     */
    public function requests()
    {
        return $this->hasMany(BloodRequest::class);
    }

    /**
     * Calculate remaining days in 90-day donation cooldown.
     */
    public function cooldownDays(): int
    {
        $latestLog = $this->donationLogs()->first();
        if (! $latestLog) {
            return 0; // No donations yet, fully eligible
        }

        $donationDate = $latestLog->donation_date->copy();
        $nextEligibleDate = $donationDate->addDays(90);
        $today = now()->startOfDay();

        if ($today->greaterThanOrEqualTo($nextEligibleDate)) {
            return 0; // Cooldown expired, fully eligible
        }

        return $today->diffInDays($nextEligibleDate);
    }

    /**
     * Calculate gamified contribution badge tier based on logs count.
     */
    public function badgeTier(): string
    {
        $count = $this->donationLogs()->count();
        if ($count === 0) {
            return 'First Drop';
        } elseif ($count <= 2) {
            return 'Life Saver';
        } else {
            return 'Guardian Angel';
        }
    }
}
