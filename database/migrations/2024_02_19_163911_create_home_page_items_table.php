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
        Schema::create('home_page_items', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('text')->nullable();
            $table->string('job_title');
            $table->string('job_category');
            $table->string('job_location');
            $table->string('search');
            $table->string('background');
            $table->text('job_category_heading');
            $table->text('job_category_subheading')->nullable();
            $table->text('job_category_status');
            $table->text('why_choose_heading');
            $table->text('why_choose_subheading')->nullable();
            $table->text('why_choose_background');
            $table->text('why_choose_status');
            $table->string('featured_job_heading');
            $table->string('featured_job_subheading')->nullable();
            $table->string('featured_job_status');
            $table->text('testimonial_heading');
            $table->text('testimonial_background');
            $table->text('testimonial_status');
            $table->text('blog_heading');
            $table->text('blog_subheading')->nullable();
            $table->text('blog_status');
            $table->text('title');
            $table->text('meta_description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_items');
    }
};
