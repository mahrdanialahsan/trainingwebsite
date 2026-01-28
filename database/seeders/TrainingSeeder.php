<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingFacility;
use App\Models\TrainingAmenity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrainingSeeder extends Seeder
{
    public function run(): void
    {
        // Training 1: Tactical Training Center
        $training1 = Training::firstOrCreate(
            ['slug' => 'tactical-training-center'],
            [
                'title' => 'Tactical Training Center',
                'about_title' => 'World-Class Tactical Training Facility',
                'about_description' => 'Our Tactical Training Center provides state-of-the-art facilities for comprehensive tactical training programs. We offer a wide range of training scenarios and environments designed to prepare individuals and teams for real-world situations.

Our facility features multiple training ranges, shoot houses, driving tracks, and specialized training areas. All training is conducted by certified instructors with extensive real-world experience.',
                'download_button_text' => 'Download Facility Brochure',
                'order' => 1,
                'is_active' => true,
            ]
        );

        // Facilities for Training 1
        $facilities1 = [
            [
                'title' => 'Shooting Ranges',
                'description' => 'Multiple indoor and outdoor shooting ranges equipped with advanced target systems and safety features. Our ranges accommodate various firearms and training scenarios.',
                'media_type' => 'image',
                'media_position' => 'left',
                'order' => 1,
            ],
            [
                'title' => 'Shoothouse',
                'description' => 'A fully configurable shoot house for realistic tactical training scenarios. Features movable walls, multiple entry points, and advanced safety systems.',
                'media_type' => 'image',
                'media_position' => 'right',
                'order' => 2,
            ],
            [
                'title' => 'Driving Tracks',
                'description' => 'Professional driving tracks designed for vehicle mobility training, pursuit driving, and defensive driving techniques.',
                'media_type' => 'image',
                'media_position' => 'left',
                'order' => 3,
            ],
        ];

        foreach ($facilities1 as $facility) {
            TrainingFacility::firstOrCreate(
                ['training_id' => $training1->id, 'title' => $facility['title']],
                array_merge($facility, [
                    'training_id' => $training1->id,
                    'is_active' => true,
                ])
            );
        }

        // Amenities for Training 1
        $amenities1 = [
            [
                'title' => 'Dining Hall',
                'description' => 'Full-service dining facility providing meals for extended training programs.',
                'media_type' => 'image',
                'media_position' => 'left',
                'order' => 1,
            ],
            [
                'title' => 'Lodging',
                'description' => 'Comfortable on-site lodging accommodations for multi-day training programs.',
                'media_type' => 'image',
                'media_position' => 'right',
                'order' => 2,
            ],
        ];

        foreach ($amenities1 as $amenity) {
            TrainingAmenity::firstOrCreate(
                ['training_id' => $training1->id, 'title' => $amenity['title']],
                array_merge($amenity, [
                    'training_id' => $training1->id,
                    'is_active' => true,
                ])
            );
        }

        // Training 2: Law Enforcement Training
        $training2 = Training::firstOrCreate(
            ['slug' => 'law-enforcement-training'],
            [
                'title' => 'Law Enforcement Training',
                'about_title' => 'Specialized Training for Law Enforcement Professionals',
                'about_description' => 'Comprehensive training programs designed specifically for law enforcement personnel. Our programs cover tactical operations, firearms training, defensive tactics, and specialized law enforcement skills.

All programs are designed to meet or exceed state and federal training standards, ensuring officers receive the highest quality instruction.',
                'download_button_text' => 'Download Training Catalog',
                'order' => 2,
                'is_active' => true,
            ]
        );

        $facilities2 = [
            [
                'title' => 'Firearms Training Range',
                'description' => 'Specialized range for law enforcement firearms training with qualification courses and tactical shooting scenarios.',
                'media_type' => 'image',
                'media_position' => 'left',
                'order' => 1,
            ],
            [
                'title' => 'Defensive Tactics Area',
                'description' => 'Dedicated area for defensive tactics training, handcuffing techniques, and use of force scenarios.',
                'media_type' => 'image',
                'media_position' => 'right',
                'order' => 2,
            ],
        ];

        foreach ($facilities2 as $facility) {
            TrainingFacility::firstOrCreate(
                ['training_id' => $training2->id, 'title' => $facility['title']],
                array_merge($facility, [
                    'training_id' => $training2->id,
                    'is_active' => true,
                ])
            );
        }

        // Training 3: Security Operations Training
        $training3 = Training::firstOrCreate(
            ['slug' => 'security-operations-training'],
            [
                'title' => 'Security Operations Training',
                'about_title' => 'Professional Security Training Programs',
                'about_description' => 'Comprehensive security operations training for security professionals, private security firms, and corporate security teams. Our programs cover threat assessment, access control, surveillance, and emergency response procedures.

Training includes both classroom instruction and hands-on practical exercises in realistic scenarios.',
                'download_button_text' => 'Download Program Information',
                'order' => 3,
                'is_active' => true,
            ]
        );

        $facilities3 = [
            [
                'title' => 'Classroom Facilities',
                'description' => 'Modern classroom facilities equipped with multimedia presentation systems and training materials.',
                'media_type' => 'image',
                'media_position' => 'left',
                'order' => 1,
            ],
            [
                'title' => 'Simulation Training Area',
                'description' => 'Advanced simulation training area for scenario-based security training exercises.',
                'media_type' => 'image',
                'media_position' => 'right',
                'order' => 2,
            ],
        ];

        foreach ($facilities3 as $facility) {
            TrainingFacility::firstOrCreate(
                ['training_id' => $training3->id, 'title' => $facility['title']],
                array_merge($facility, [
                    'training_id' => $training3->id,
                    'is_active' => true,
                ])
            );
        }
    }
}
