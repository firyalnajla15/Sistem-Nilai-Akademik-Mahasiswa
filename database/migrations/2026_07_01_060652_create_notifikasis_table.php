<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {

            $table->id();

            $table->string('nim');

            $table->string('judul');

            $table->text('pesan');

            $table->enum('jenis',[
                'nilai',
                'krs',
                'informasi'
            ])->default('nilai');

            $table->boolean('dibaca')->default(false);

            $table->timestamps();

            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswa')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};