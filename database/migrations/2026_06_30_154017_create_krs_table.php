<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('mata_kuliah_id')
                ->constrained('mata_kuliah')
                ->cascadeOnDelete();

            $table->string('tahun_akademik');

            $table->enum('semester_akademik', [
                'Ganjil',
                'Genap'
            ]);

            $table->enum('status', [
                'Pending',
                'Disetujui',
                'Ditolak'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};