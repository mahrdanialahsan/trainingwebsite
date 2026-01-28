<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        // General FAQs
        $generalFaqs = [
            [
                'question' => 'What services do you provide?',
                'answer' => 'We provide comprehensive training programs, consulting services, and specialized courses tailored to your needs.',
                'type' => 'general',
                'displayorder' => 1,
                'status' => true,
            ],
            [
                'question' => 'How do I book a course?',
                'answer' => 'You can browse our courses page, select a course that interests you, and click "Book Now" to start the booking process. You will need to provide your information, accept the waiver, and complete payment.',
                'type' => 'general',
                'displayorder' => 2,
                'status' => true,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept credit and debit cards through our secure Stripe payment gateway. All payments are processed securely and encrypted.',
                'type' => 'general',
                'displayorder' => 3,
                'status' => true,
            ],
        ];

        // About Us FAQs
        $aboutUsFaqs = [
            [
                'question' => 'How long has the company been in business?',
                'answer' => 'We have been providing professional training and consulting services for over 10 years, helping thousands of individuals and organizations achieve their goals.',
                'type' => 'about-us',
                'displayorder' => 1,
                'status' => true,
            ],
            [
                'question' => 'What makes your training programs unique?',
                'answer' => 'Our training programs combine practical, hands-on experience with expert instruction. We focus on real-world applications and provide ongoing support to ensure your success.',
                'type' => 'about-us',
                'displayorder' => 2,
                'status' => true,
            ],
            [
                'question' => 'Do you offer customized training programs?',
                'answer' => 'Yes, we offer customized training programs tailored to your specific needs. Contact us to discuss how we can create a program that fits your organization.',
                'type' => 'about-us',
                'displayorder' => 3,
                'status' => true,
            ],
        ];

        // Consulting FAQs
        $consultingFaqs = [
            [
                'question' => 'How long does a typical consulting engagement last?',
                'answer' => 'Engagement duration varies based on project scope and complexity. Short-term projects may last 2-4 weeks, while comprehensive transformations can span 3-6 months or longer. We work with you to establish realistic timelines and milestones.',
                'type' => 'consulting',
                'displayorder' => 1,
                'status' => true,
            ],
            [
                'question' => 'What is your consulting methodology?',
                'answer' => 'We follow a structured yet flexible approach: Discovery (understanding your needs), Strategy (developing solutions), Implementation (executing plans), and Optimization (continuous improvement). Each phase is customized to your specific situation.',
                'type' => 'consulting',
                'displayorder' => 2,
                'status' => true,
            ],
            [
                'question' => 'Do you work with organizations of all sizes?',
                'answer' => 'Yes, we work with startups, small businesses, mid-market companies, and large enterprises. Our services are scalable and adaptable to organizations of any size.',
                'type' => 'consulting',
                'displayorder' => 3,
                'status' => true,
            ],
            [
                'question' => 'How do you ensure confidentiality?',
                'answer' => 'We take confidentiality seriously and sign non-disclosure agreements (NDAs) before beginning any engagement. All consultants are bound by strict confidentiality and ethical standards.',
                'type' => 'consulting',
                'displayorder' => 4,
                'status' => true,
            ],
            [
                'question' => 'What are your rates and pricing structure?',
                'answer' => 'Pricing depends on project scope, duration, and complexity. We offer fixed-price projects, hourly rates, and retainer arrangements. Contact us for a customized quote based on your specific needs.',
                'type' => 'consulting',
                'displayorder' => 5,
                'status' => true,
            ],
            [
                'question' => 'Will you work with our existing team?',
                'answer' => 'Absolutely! We believe in collaborative partnerships. We work alongside your team, providing guidance, training, and support to build internal capabilities and ensure sustainable results.',
                'type' => 'consulting',
                'displayorder' => 6,
                'status' => true,
            ],
        ];

        $allFaqs = array_merge($generalFaqs, $aboutUsFaqs, $consultingFaqs);

        foreach ($allFaqs as $faq) {
            Faq::firstOrCreate(
                ['question' => $faq['question'], 'type' => $faq['type']],
                $faq
            );
        }
    }
}
