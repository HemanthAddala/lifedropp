<?php

namespace Database\Seeders;

use App\Models\BloodRequest;
use App\Models\DonationLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin Account
        User::create([
            'name' => 'Lifedrop Administrator',
            'email' => 'admin@lifedrop.org',
            'password' => Hash::make('AdminPassword123!'),
            'phone' => '+1 (555) 000-0000',
            'dob' => '1985-01-01',
            'gender' => 'Other',
            'city' => 'Global',
            'blood_group' => 'O-',
            'avatar' => null,
            'is_available' => false,
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // 2. Create Mock Donors
        // Donor A: John Doe (O+, New York, has active 90-day cooldown, Guardian Angel)
        $john = User::create([
            'name' => 'John Doe',
            'email' => 'john@lifedrop.org',
            'password' => Hash::make('DonorPassword123!'),
            'phone' => '+1 (555) 123-4567',
            'dob' => '1990-05-15',
            'gender' => 'Male',
            'city' => 'New York',
            'blood_group' => 'O+',
            'avatar' => null,
            'is_available' => true,
            'role' => 'donor',
            'is_verified' => true,
        ]);

        // John has 3 donations. Latest is 10 days ago. This triggers active cooldown!
        DonationLog::create([
            'user_id' => $john->id,
            'donation_date' => now()->subDays(180),
            'location' => 'Red Cross NY Center',
            'units' => 1,
        ]);
        DonationLog::create([
            'user_id' => $john->id,
            'donation_date' => now()->subDays(100),
            'location' => 'Metropolitan Hospital',
            'units' => 1,
        ]);
        DonationLog::create([
            'user_id' => $john->id,
            'donation_date' => now()->subDays(10), // Latest
            'location' => 'Bellevue Health Center',
            'units' => 1,
        ]);

        // Donor B: Sarah Connor (AB-, Los Angeles, fully eligible now, Life Saver)
        $sarah = User::create([
            'name' => 'Sarah Connor',
            'email' => 'sarah@lifedrop.org',
            'password' => Hash::make('DonorPassword123!'),
            'phone' => '+1 (555) 987-6543',
            'dob' => '1988-11-22',
            'gender' => 'Female',
            'city' => 'Los Angeles',
            'blood_group' => 'AB-',
            'avatar' => null,
            'is_available' => true,
            'role' => 'donor',
            'is_verified' => true,
        ]);

        // Sarah has 1 donation, 95 days ago. Cooldown is over, she is available!
        DonationLog::create([
            'user_id' => $sarah->id,
            'donation_date' => now()->subDays(95),
            'location' => 'UCLA Blood Donor Center',
            'units' => 1,
        ]);

        // Donor C: David Miller (A+, Chicago, fully eligible now, First Drop)
        $david = User::create([
            'name' => 'David Miller',
            'email' => 'david@lifedrop.org',
            'password' => Hash::make('DonorPassword123!'),
            'phone' => '+1 (555) 234-5678',
            'dob' => '1995-07-08',
            'gender' => 'Male',
            'city' => 'Chicago',
            'blood_group' => 'A+',
            'avatar' => null,
            'is_available' => true,
            'role' => 'donor',
            'is_verified' => true,
        ]);

        // Donor D: Emma Watson (B-, Houston, toggled off/unavailable, First Drop)
        $emma = User::create([
            'name' => 'Emma Watson',
            'email' => 'emma@lifedrop.org',
            'password' => Hash::make('DonorPassword123!'),
            'phone' => '+1 (555) 345-6789',
            'dob' => '1993-04-15',
            'gender' => 'Female',
            'city' => 'Houston',
            'blood_group' => 'B-',
            'avatar' => null,
            'is_available' => false, // unavailable
            'role' => 'donor',
            'is_verified' => true,
        ]);

        // 3. Create Active Emergency Blood Requests
        BloodRequest::create([
            'patient_name' => 'Robert Chen',
            'blood_group' => 'A+',
            'units' => 3,
            'hospital_name' => 'Mount Sinai Hospital',
            'hospital_address' => '1190 5th Ave, New York, NY 10029',
            'city' => 'New York',
            'contact_person' => 'Alice Chen',
            'contact_phone' => '+1 (555) 901-2345',
            'urgency' => 'urgent',
            'is_approved' => true,
            'status' => 'active',
        ]);

        BloodRequest::create([
            'patient_name' => 'Maria Garcia',
            'blood_group' => 'O-',
            'units' => 2,
            'hospital_name' => 'Ronald Reagan UCLA Medical Center',
            'hospital_address' => '757 Westwood Plaza, Los Angeles, CA 90095',
            'city' => 'Los Angeles',
            'contact_person' => 'Luis Garcia',
            'contact_phone' => '+1 (555) 890-1234',
            'urgency' => 'urgent',
            'is_approved' => true,
            'status' => 'active',
        ]);

        BloodRequest::create([
            'patient_name' => 'James Smith',
            'blood_group' => 'B+',
            'units' => 1,
            'hospital_name' => 'Northwestern Memorial Hospital',
            'hospital_address' => '251 E Huron St, Chicago, IL 60611',
            'city' => 'Chicago',
            'contact_person' => 'Sarah Smith',
            'contact_phone' => '+1 (555) 789-0123',
            'urgency' => 'normal',
            'is_approved' => true,
            'status' => 'active',
        ]);
    }
}
