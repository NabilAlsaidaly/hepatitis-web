<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            // حذف العمود القديم إن وُجد
            if (Schema::hasColumn('diagnoses', 'disease_stage')) {
                $table->dropColumn('disease_stage');
            }

            // إضافة الأعمدة الجديدة
            $table->text('Final_Diagnosis')->nullable()->after('Record_ID');
            $table->text('Prescription')->nullable()->after('Final_Diagnosis');
        });
    }

    public function down(): void
    {
        Schema::table('diagnoses', function (Blueprint $table) {
            $table->dropColumn(['Final_Diagnosis', 'Prescription']);
            $table->string('disease_stage')->nullable();
        });
    }
};
