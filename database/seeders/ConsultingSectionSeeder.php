<?php

namespace Database\Seeders;

use App\Models\ConsultingSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultingSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        ConsultingSection::firstOrCreate(
            ['section_type' => 'hero', 'order' => 1],
            [
                'title' => 'Professional Consulting Services',
                'subtitle' => 'Transform your organization with expert guidance, strategic insights, and proven methodologies tailored to your unique challenges',
                'button_text' => 'Schedule a Consultation',
                'button_link' => '#contact',
                'is_active' => true,
            ]
        );

        // Overview Section
        ConsultingSection::firstOrCreate(
            ['section_type' => 'overview', 'order' => 2],
            [
                'title' => 'Why Choose Our Consulting Services?',
                'content' => 'Our consulting services are designed to help organizations navigate complex challenges, optimize operations, and achieve sustainable growth. With years of experience across diverse industries, we bring a wealth of knowledge and a results-driven approach to every engagement.

We understand that every organization is unique, which is why we take a customized approach to each project. Our consultants work closely with your team to understand your specific needs, culture, and objectives, ensuring that our recommendations are not only strategic but also practical and implementable.',
                'is_active' => true,
            ]
        );

        // Services
        $services = [
            [
                'title' => 'Strategic Planning',
                'content' => 'Develop comprehensive strategic plans that align with your vision and drive measurable results. We help you identify opportunities, set clear objectives, and create actionable roadmaps.',
                'additional_data' => [
                    'items' => [
                        'Business strategy development',
                        'Market analysis and positioning',
                        'Competitive intelligence',
                        'Growth planning',
                    ]
                ],
                'order' => 1,
            ],
            [
                'title' => 'Organizational Development',
                'content' => 'Enhance your organizational structure, culture, and capabilities. We work with you to build high-performing teams and create environments that foster innovation and excellence.',
                'additional_data' => [
                    'items' => [
                        'Organizational design',
                        'Change management',
                        'Team building and development',
                        'Culture transformation',
                    ]
                ],
                'order' => 2,
            ],
            [
                'title' => 'Process Optimization',
                'content' => 'Streamline your operations and eliminate inefficiencies. Our process improvement methodologies help you reduce costs, improve quality, and enhance customer satisfaction.',
                'additional_data' => [
                    'items' => [
                        'Workflow analysis',
                        'Lean and Six Sigma implementation',
                        'Quality management systems',
                        'Performance metrics and KPIs',
                    ]
                ],
                'order' => 3,
            ],
            [
                'title' => 'Technology Consulting',
                'content' => 'Leverage technology to drive innovation and competitive advantage. We help you select, implement, and optimize technology solutions that align with your business goals.',
                'additional_data' => [
                    'items' => [
                        'Digital transformation',
                        'System integration',
                        'Technology assessment',
                        'IT strategy and planning',
                    ]
                ],
                'order' => 4,
            ],
            [
                'title' => 'Financial Advisory',
                'content' => 'Make informed financial decisions with expert guidance. Our financial consultants help you optimize cash flow, manage risk, and plan for sustainable growth.',
                'additional_data' => [
                    'items' => [
                        'Financial planning and analysis',
                        'Budgeting and forecasting',
                        'Cost reduction strategies',
                        'Investment planning',
                    ]
                ],
                'order' => 5,
            ],
            [
                'title' => 'Risk Management',
                'content' => 'Identify, assess, and mitigate risks that could impact your organization. We develop comprehensive risk management frameworks to protect your assets and reputation.',
                'additional_data' => [
                    'items' => [
                        'Risk assessment and analysis',
                        'Compliance and regulatory guidance',
                        'Business continuity planning',
                        'Crisis management',
                    ]
                ],
                'order' => 6,
            ],
        ];

        foreach ($services as $service) {
            ConsultingSection::firstOrCreate(
                ['section_type' => 'services', 'title' => $service['title']],
                array_merge($service, [
                    'section_type' => 'services',
                    'is_active' => true,
                ])
            );
        }

        // Approach Steps
        $approachSteps = [
            [
                'title' => 'Discovery',
                'content' => 'We begin by understanding your organization, challenges, goals, and unique context through comprehensive analysis and stakeholder interviews.',
                'order' => 1,
            ],
            [
                'title' => 'Strategy',
                'content' => 'Based on our findings, we develop customized strategies and solutions tailored to your specific needs and objectives.',
                'order' => 2,
            ],
            [
                'title' => 'Implementation',
                'content' => 'We work alongside your team to implement solutions, providing guidance, training, and support throughout the process.',
                'order' => 3,
            ],
            [
                'title' => 'Optimization',
                'content' => 'We monitor results, measure success, and make continuous improvements to ensure long-term sustainability and value.',
                'order' => 4,
            ],
        ];

        foreach ($approachSteps as $step) {
            ConsultingSection::firstOrCreate(
                ['section_type' => 'approach', 'title' => $step['title']],
                array_merge($step, [
                    'section_type' => 'approach',
                    'is_active' => true,
                ])
            );
        }

        // Benefits
        $benefits = [
            [
                'title' => 'Expert Knowledge',
                'content' => 'Access to industry-leading expertise and best practices from experienced consultants.',
                'order' => 1,
            ],
            [
                'title' => 'Customized Solutions',
                'content' => 'Tailored strategies and recommendations designed specifically for your organization.',
                'order' => 2,
            ],
            [
                'title' => 'Proven Methodologies',
                'content' => 'Time-tested frameworks and approaches that deliver measurable results.',
                'order' => 3,
            ],
            [
                'title' => 'Faster Results',
                'content' => 'Accelerate your progress with focused guidance and actionable insights.',
                'order' => 4,
            ],
            [
                'title' => 'Cost Efficiency',
                'content' => 'Optimize resources and reduce waste through strategic planning and process improvement.',
                'order' => 5,
            ],
            [
                'title' => 'Long-term Partnership',
                'content' => 'Ongoing support and relationship building for sustained success.',
                'order' => 6,
            ],
        ];

        foreach ($benefits as $benefit) {
            ConsultingSection::firstOrCreate(
                ['section_type' => 'benefits', 'title' => $benefit['title']],
                array_merge($benefit, [
                    'section_type' => 'benefits',
                    'is_active' => true,
                ])
            );
        }

        // CTA Section
        ConsultingSection::firstOrCreate(
            ['section_type' => 'cta', 'order' => 10],
            [
                'title' => "Let's Transform Your Organization Together",
                'content' => 'Take the first step towards achieving your goals. Schedule a free consultation to discuss your needs and explore how we can help.',
                'button_text' => 'Get Started Today',
                'button_link' => '#contact',
                'is_active' => true,
            ]
        );
    }
}
