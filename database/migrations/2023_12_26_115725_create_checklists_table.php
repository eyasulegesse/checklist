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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string('date');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('main_check_list_id');
            $table->foreign('main_check_list_id')->references('id')->on('main_check_lists')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('sub_checklist_id');
            $table->foreign('sub_checklist_id')->references('id')->on('sub_checklists')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('checklist_task_id');
            $table->foreign('checklist_task_id')->references('id')->on('checklist_tasks')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
