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
        Schema::table('training_amenities', function (Blueprint $table) {
            if (!Schema::hasColumn('training_amenities', 'training_id')) {
                $table->foreignId('training_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('training_amenities', 'title')) {
                $table->string('title')->after('training_id');
            }
            if (!Schema::hasColumn('training_amenities', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('training_amenities', 'image_path')) {
                $table->string('image_path')->nullable()->after('description');
            }
            if (!Schema::hasColumn('training_amenities', 'video_path')) {
                $table->string('video_path')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('training_amenities', 'media_type')) {
                $table->enum('media_type', ['image', 'video'])->default('image')->after('video_path');
            }
            if (!Schema::hasColumn('training_amenities', 'media_position')) {
                $table->enum('media_position', ['left', 'right'])->default('left')->after('media_type');
            }
            if (!Schema::hasColumn('training_amenities', 'order')) {
                $table->integer('order')->default(0)->after('media_position');
            }
            if (!Schema::hasColumn('training_amenities', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
        });
    }

    public function down(): void
    {
        Schema::table('training_amenities', function (Blueprint $table) {
            $table->dropForeign(['training_id']);
            $table->dropColumn(['training_id', 'title', 'description', 'image_path', 'video_path', 'media_type', 'media_position', 'order', 'is_active']);
        });
    }
};
