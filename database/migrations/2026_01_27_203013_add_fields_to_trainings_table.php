<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            if (!Schema::hasColumn('trainings', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('trainings', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            if (!Schema::hasColumn('trainings', 'about_title')) {
                $table->text('about_title')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('trainings', 'about_description')) {
                $table->text('about_description')->nullable()->after('about_title');
            }
            if (!Schema::hasColumn('trainings', 'download_button_text')) {
                $table->string('download_button_text')->nullable()->after('about_description');
            }
            if (!Schema::hasColumn('trainings', 'download_pdf_path')) {
                $table->string('download_pdf_path')->nullable()->after('download_button_text');
            }
            if (!Schema::hasColumn('trainings', 'order')) {
                $table->integer('order')->default(0)->after('download_pdf_path');
            }
            if (!Schema::hasColumn('trainings', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn(['title', 'slug', 'about_title', 'about_description', 'download_button_text', 'download_pdf_path', 'order', 'is_active']);
        });
    }
};
