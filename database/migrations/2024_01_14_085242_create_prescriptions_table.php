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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_no')->unique();
            $table->foreignId('patient_id')->constrained();
            $table->date('date');
            $table->integer('visit_no');
            $table->foreignId('referred_to')->constrained('doctors');
            $table->decimal('visit_fees')->default(0);
            $table->text('tests');
            $table->text('medicines');
            $table->text('description');
            $table->text('advice');
            $table->string('prescribed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
