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
        Schema::create('send_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_title');
            $table->longText('report_detail');
            $table->string('date');
            $table->unsignedBigInteger('send_report_by_id');
            $table->foreign('send_report_by_id')->references('id')->on('send_report_by')->onUpdate("cascade")->onDelete('cascade');
            $table->unsignedBigInteger('send_report_to_id');
            $table->foreign('send_report_to_id')->references('id')->on('send_report_to')->onUpdate("cascade")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_reports');
    }
};
