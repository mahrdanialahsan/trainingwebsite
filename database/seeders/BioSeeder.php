<?php

namespace Database\Seeders;

use App\Models\Bio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bio::firstOrCreate(
            ['type' => 'owner'],
            [
                'name' => 'Owner Name',
                'tagline' => 'Expert Trainer & Founder',
                'bio' => '<p>Owner bio information will be displayed here. This section can be managed from the admin panel.</p><p>With years of experience in the industry, our owner brings a wealth of knowledge and expertise to every training program.</p>',
                'email' => 'owner@training.com',
                'phone' => '',
                'credentials' => '<p>Certified Professional Trainer</p><p>Industry Expert with 15+ Years Experience</p>',
                'experience' => '<p>Extensive experience in training and development, having worked with numerous organizations to enhance their teams\' capabilities.</p>',
                'is_active' => true,
            ]
        );

        Bio::firstOrCreate(
            ['type' => 'partner'],
            [
                'name' => 'Partner Name',
                'tagline' => 'Senior Consultant & Partner',
                'bio' => '<p>Partner bio information will be displayed here. This section can be managed from the admin panel.</p><p>Our partner specializes in strategic consulting and organizational development, helping businesses achieve their goals.</p>',
                'email' => 'partner@training.com',
                'phone' => '',
                'credentials' => '<p>MBA in Business Administration</p><p>Certified Management Consultant</p>',
                'experience' => '<p>Over 10 years of consulting experience across various industries, helping organizations transform and grow.</p>',
                'is_active' => true,
            ]
        );
    }
}
