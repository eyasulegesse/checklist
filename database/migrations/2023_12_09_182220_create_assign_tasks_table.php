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
        Schema::create('assign_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->string('date');
            $table->string('status')->default('assigned');
            $table->unsignedBigInteger('task_assigned_by_id');
            $table->foreign('task_assigned_by_id')->references('id')->on('task_assigned_by')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('task_assigned_to_id');
            $table->foreign('task_assigned_to_id')->references('id')->on('task_assigned_to')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_tasks');
    }
};
