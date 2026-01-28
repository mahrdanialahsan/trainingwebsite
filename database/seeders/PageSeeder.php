<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about',
                'title' => 'About Us',
                'content' => '<h2>Our Story</h2>
<p>Training Company was founded with a mission to provide high-quality professional development and training services. We believe that continuous learning is essential for personal and professional growth.</p>

<h2>Our Mission</h2>
<p>Our mission is to empower individuals and organizations through comprehensive training programs that enhance skills, boost productivity, and drive career advancement.</p>

<h2>Our Values</h2>
<ul>
    <li><strong>Excellence:</strong> We are committed to delivering the highest quality training programs</li>
    <li><strong>Integrity:</strong> We conduct our business with honesty and transparency</li>
    <li><strong>Innovation:</strong> We continuously update our curriculum to reflect industry best practices</li>
    <li><strong>Support:</strong> We provide ongoing support to help our students succeed</li>
</ul>',
                'meta_title' => 'About Us - Training Company',
                'meta_description' => 'Learn about Training Company, our mission, values, and commitment to professional development.',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'slug' => 'contact',
                'title' => 'Contact Us',
                'content' => '<h2>Get in Touch</h2>
<p>We\'d love to hear from you. Whether you have questions about our courses, need consulting services, or want to discuss custom training solutions, we\'re here to help.</p>

<h3>Contact Information</h3>
<p><strong>Email:</strong> info@training.com<br>
<strong>Phone:</strong> (555) 123-4567<br>
<strong>Address:</strong> 123 Training Street, Education City, EC 12345</p>

<h3>Business Hours</h3>
<p>Monday - Friday: 9:00 AM - 6:00 PM<br>
Saturday: 10:00 AM - 4:00 PM<br>
Sunday: Closed</p>

<h3>Send Us a Message</h3>
<p>For inquiries about our training programs or to schedule a consultation, please contact us using the information above.</p>',
                'meta_title' => 'Contact Us - Training Company',
                'meta_description' => 'Contact Training Company for questions about our courses, consulting services, or custom training solutions.',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::firstOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
