<?php

namespace App\Console\Commands;

use App\Models\Course;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateCourseSlugs extends Command
{
    protected $signature = 'courses:update-slugs';
    protected $description = 'Update all courses that are missing slugs';

    public function handle()
    {
        $courses = Course::whereNull('slug')->orWhere('slug', '')->get();
        
        if ($courses->isEmpty()) {
            $this->info('All courses already have slugs.');
            return 0;
        }

        $this->info("Found {$courses->count()} courses without slugs. Updating...");

        foreach ($courses as $course) {
            $slug = Str::slug($course->title);
            $originalSlug = $slug;
            $counter = 1;
            
            // Ensure uniqueness
            while (Course::where('slug', $slug)->where('id', '!=', $course->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $course->slug = $slug;
            $course->saveQuietly();
            $this->line("Updated: {$course->title} -> {$slug}");
        }

        $this->info('All courses updated successfully!');
        return 0;
    }
}
