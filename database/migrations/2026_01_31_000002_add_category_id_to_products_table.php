<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('image_path')->constrained('categories')->nullOnDelete();
        });

        $distinct = \Illuminate\Support\Facades\DB::table('products')
            ->select('category')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category');

        foreach ($distinct as $name) {
            $slug = Str::slug($name);
            $existing = \Illuminate\Support\Facades\DB::table('categories')->where('slug', $slug)->first();
            if ($existing) {
                \Illuminate\Support\Facades\DB::table('products')->where('category', $name)->update(['category_id' => $existing->id]);
                continue;
            }
            $slugBase = $slug;
            $counter = 1;
            while (\Illuminate\Support\Facades\DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $counter++;
            }
            $id = \Illuminate\Support\Facades\DB::table('categories')->insertGetId([
                'name' => $name,
                'slug' => $slug,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            \Illuminate\Support\Facades\DB::table('products')->where('category', $name)->update(['category_id' => $id]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('image_path');
        });

        $categories = \Illuminate\Support\Facades\DB::table('categories')->get();
        foreach ($categories as $cat) {
            \Illuminate\Support\Facades\DB::table('products')->where('category_id', $cat->id)->update(['category' => $cat->name]);
        }

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
    }
};
