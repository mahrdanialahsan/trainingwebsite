<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thumbnailImages = [
            'images/thumbnails/image01.png',
            'images/thumbnails/image02.png',
            'images/thumbnails/image03.png',
            'images/thumbnails/image04.png',
            'images/thumbnails/image05.png',
            'images/thumbnails/image06.png',
            'images/thumbnails/image07.png',
            'images/thumbnails/image08.png',
        ];

        $courses = [
            [
                'title' => 'Advanced Leadership Training',
                'description' => 'Develop essential leadership skills including team management, strategic thinking, and effective communication.',
                'long_description' => '<p>This comprehensive course is designed for managers and aspiring leaders who want to enhance their leadership capabilities. Through interactive sessions, real-world case studies, and practical exercises, you will learn:</p><ul><li>Effective team management strategies</li><li>Strategic thinking and decision-making</li><li>Communication techniques for leaders</li><li>Conflict resolution and negotiation</li><li>Building high-performing teams</li></ul><p>Our expert instructors bring years of industry experience to help you become a more effective leader.</p>',
                'thumbnail_image' => $thumbnailImages[0],
                'date' => Carbon::now()->addDays(14)->format('Y-m-d'),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'price' => 499.00,
                'max_participants' => 20,
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title' => 'Project Management Fundamentals',
                'description' => 'Learn the core principles of project management including planning, execution, monitoring, and closing projects.',
                'long_description' => '<p>Perfect for professionals looking to improve their project management skills. This course covers:</p><ul><li>Project planning and scheduling</li><li>Resource allocation and management</li><li>Risk assessment and mitigation</li><li>Quality control and assurance</li><li>Stakeholder communication</li><li>Project closure and evaluation</li></ul><p>Gain practical skills that you can apply immediately to your projects.</p>',
                'thumbnail_image' => $thumbnailImages[1],
                'date' => Carbon::now()->addDays(21)->format('Y-m-d'),
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'price' => 399.00,
                'max_participants' => 25,
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Masterclass',
                'description' => 'Master the art of digital marketing including SEO, social media marketing, content strategy, and analytics.',
                'long_description' => '<p>This hands-on course will help you create effective digital marketing campaigns. Learn:</p><ul><li>Search Engine Optimization (SEO) techniques</li><li>Social media marketing strategies</li><li>Content creation and distribution</li><li>Email marketing campaigns</li><li>Analytics and performance measurement</li><li>Paid advertising (PPC, Social Ads)</li></ul><p>Work on real-world projects and develop a comprehensive digital marketing portfolio.</p>',
                'thumbnail_image' => $thumbnailImages[2],
                'date' => Carbon::now()->addDays(28)->format('Y-m-d'),
                'start_time' => '09:30:00',
                'end_time' => '17:30:00',
                'price' => 449.00,
                'max_participants' => 30,
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title' => 'Data Analysis & Excel Advanced',
                'description' => 'Learn advanced Excel techniques and data analysis methods.',
                'long_description' => '<p>This course covers pivot tables, complex formulas, data visualization, and statistical analysis using Excel. Topics include:</p><ul><li>Advanced Excel functions and formulas</li><li>Pivot tables and data modeling</li><li>Data visualization with charts and graphs</li><li>Statistical analysis and forecasting</li><li>Macros and automation</li><li>Data cleaning and preparation</li></ul><p>Perfect for professionals who work with data and need to analyze and present information effectively.</p>',
                'thumbnail_image' => $thumbnailImages[3],
                'date' => Carbon::now()->addDays(35)->format('Y-m-d'),
                'start_time' => '09:00:00',
                'end_time' => '16:00:00',
                'price' => 349.00,
                'max_participants' => 15,
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title' => 'Communication Skills Workshop',
                'description' => 'Enhance your communication skills for professional success.',
                'long_description' => '<p>Learn effective presentation techniques, public speaking, written communication, and interpersonal skills. This workshop includes:</p><ul><li>Public speaking and presentation skills</li><li>Active listening techniques</li><li>Written communication best practices</li><li>Non-verbal communication</li><li>Conflict resolution through communication</li><li>Building rapport and relationships</li></ul><p>Practice your skills through interactive exercises and receive personalized feedback.</p>',
                'thumbnail_image' => $thumbnailImages[4],
                'date' => Carbon::now()->addDays(42)->format('Y-m-d'),
                'start_time' => '10:00:00',
                'end_time' => '15:00:00',
                'price' => 299.00,
                'max_participants' => 20,
                'status' => 'upcoming',
                'is_active' => true,
            ],
            [
                'title' => 'Time Management & Productivity',
                'description' => 'Master time management techniques and productivity strategies.',
                'long_description' => '<p>Learn how to prioritize tasks, eliminate distractions, and achieve more in less time. This course covers:</p><ul><li>Goal setting and prioritization</li><li>Time blocking and scheduling</li><li>Productivity tools and techniques</li><li>Delegation strategies</li><li>Managing interruptions and distractions</li><li>Work-life balance</li></ul><p>Transform your daily routine and increase your productivity with proven methods.</p>',
                'thumbnail_image' => $thumbnailImages[5],
                'date' => Carbon::now()->addDays(49)->format('Y-m-d'),
                'start_time' => '09:00:00',
                'end_time' => '13:00:00',
                'price' => 249.00,
                'max_participants' => 25,
                'status' => 'upcoming',
                'is_active' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            // Generate slug if not provided
            if (!isset($courseData['slug'])) {
                $courseData['slug'] = \Illuminate\Support\Str::slug($courseData['title']);
            }
            
            Course::firstOrCreate(
                ['slug' => $courseData['slug']],
                $courseData
            );
        }
    }
}
