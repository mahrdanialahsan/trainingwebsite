<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hero/Introduction Section
        AboutSection::firstOrCreate(
            ['section_type' => 'hero'],
            [
                'title' => 'About ' . config('app.name', 'Training Company'),
                'content' => '<p>We are dedicated to providing exceptional training and consulting services. Our mission is to empower individuals and organizations through comprehensive programs that enhance skills and drive success.</p>',
                'additional_data' => [
                    'subtitle' => 'Your Premier Training Destination',
                ],
                'media_type' => 'image',
                'order' => 1,
                'is_active' => true,
            ]
        );

        // What We Offer Section
        AboutSection::firstOrCreate(
            ['section_type' => 'what_we_offer'],
            [
                'title' => 'What We Offer',
                'content' => null,
                'additional_data' => [
                    'items' => [
                        'High-level service',
                        'Focus on safety',
                        'Tailored solutions',
                        'Team of experts',
                    ],
                ],
                'media_type' => 'image',
                'order' => 2,
                'is_active' => true,
            ]
        );

        // Who We Are Section
        AboutSection::firstOrCreate(
            ['section_type' => 'who_we_are'],
            [
                'title' => 'Who We Are',
                'content' => '<p>We are a dedicated team of professionals committed to excellence in training and development. Our experienced instructors bring years of expertise to every program.</p>',
                'additional_data' => [
                    'items' => [
                        'Highly trained professionals',
                        'Dedicated to excellence',
                        'Years of experience',
                        'Personalized approach',
                    ],
                ],
                'media_type' => 'image',
                'order' => 3,
                'is_active' => true,
            ]
        );

        // Training Means Safety Section
        AboutSection::firstOrCreate(
            ['section_type' => 'training_safety'],
            [
                'title' => 'Training Means Safety',
                'content' => null,
                'additional_data' => [
                    'items' => [
                        'Comprehensive safety protocols',
                        'Certified instructors',
                        'Quality training equipment',
                        'Ongoing support and guidance',
                    ],
                ],
                'media_type' => 'image',
                'order' => 4,
                'is_active' => true,
            ]
        );

        // Why Choose Us Section (multiple items)
        $whyChooseUsItems = [
            [
                'title' => 'Experienced Instructors',
                'content' => 'Our team consists of highly qualified professionals with years of industry experience.',
                'order' => 1,
            ],
            [
                'title' => 'State-of-the-Art Facilities',
                'content' => 'Modern training facilities equipped with the latest technology and equipment.',
                'order' => 2,
            ],
            [
                'title' => 'Customized Programs',
                'content' => 'Tailored training solutions designed to meet your specific needs and objectives.',
                'order' => 3,
            ],
            [
                'title' => 'Commitment to Safety',
                'content' => 'Safety is our top priority in all our training programs and facilities.',
                'order' => 4,
            ],
        ];

        foreach ($whyChooseUsItems as $item) {
            AboutSection::firstOrCreate(
                [
                    'section_type' => 'why_choose_us',
                    'title' => $item['title'],
                ],
                [
                    'content' => $item['content'],
                    'media_type' => 'image',
                    'order' => $item['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
