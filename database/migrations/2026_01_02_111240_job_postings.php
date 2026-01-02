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
        Schema::create('job_postings', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('employer_id');
            $table->string('title');
            $table->text('description');
            $table->json('skills');
            $table->text('experience');
            $table->uuid('location_id')->nullable();    
            $table->enum('work_type', ['remote', 'on-site', 'hybrid']);
            $table->boolean('active')->default(true);
            $table->unsignedInteger('applications_count')->default(0);
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'internship', 'temporary']);
            $table->enum('job_time', ['day', 'night', 'flexible']);
            $table->decimal('salary_min')->nullable();
            $table->decimal('salary_max')->nullable();
            $table->string('education')->nullable();
            $table->date('ending_date')->nullable();
            $table->timestamp('posted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('employer_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            $table->index('employer_id');
            $table->index('active');
            $table->index('job_type');
            $table->foreign('location_id')
                ->references('id')
                ->on('job_locations')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
