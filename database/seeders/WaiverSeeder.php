<?php

namespace Database\Seeders;

use App\Models\Waiver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Waiver::firstOrCreate(
            ['title' => 'Training Course Waiver and Release of Liability'],
            [
                'content' => 'RELEASE OF LIABILITY, WAIVER OF CLAIMS, ASSUMPTION OF RISKS AND INDEMNITY AGREEMENT

By signing this waiver, I acknowledge that I have read, understood, and agree to the following terms and conditions:

1. ACKNOWLEDGMENT OF RISKS
I understand that participation in training courses may involve risks, including but not limited to physical injury, property damage, or other losses. I voluntarily assume all risks associated with my participation.

2. RELEASE OF LIABILITY
I hereby release, waive, discharge, and covenant not to sue Training Company, its officers, employees, instructors, agents, and representatives from any and all liability, claims, demands, actions, and causes of action whatsoever arising out of or related to any loss, damage, or injury that may be sustained by me while participating in the training course.

3. MEDICAL ACKNOWLEDGMENT
I certify that I am physically fit and have no medical conditions that would prevent my participation in the training course. I agree to inform the instructor of any medical conditions or limitations.

4. PHOTOGRAPHY AND RECORDING
I grant permission for Training Company to use photographs, videos, or other recordings of me taken during the course for promotional or educational purposes.

5. PARTICIPATION AGREEMENT
I agree to follow all instructions, rules, and guidelines provided by the instructors and Training Company staff. I understand that failure to comply may result in removal from the course without refund.

6. REFUND POLICY
I acknowledge that I have read and understand the refund and cancellation policy of Training Company.

By signing below, I acknowledge that I have read this entire waiver, understand its terms, and agree to be bound by them.',
                'is_active' => true,
                'version' => 1,
            ]
        );
    }
    //
}
