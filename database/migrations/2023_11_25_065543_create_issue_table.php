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
        Schema::create('issue', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0);
            $table->integer('tracker_id')->nullable()->default(0);
            $table->string('subject');
            $table->longText('description')->nullable();
            $table->integer('status_id')->default(0)->nullable();
            $table->integer('priority_id')->nullable()->default(0);
            $table->date('due_date')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('assigned_to_id')->default(0);
            $table->integer('fixed_version_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('lock_version')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue');
    }
};
