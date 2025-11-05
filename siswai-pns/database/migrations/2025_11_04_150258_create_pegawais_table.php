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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama', 150);
            $table->string('tempat_lahir', 100);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('tempat_tugas', 100);
            $table->string('no_hp', 20)->nullable();
            $table->string('npwp', 25)->nullable()->unique();
            $table->string('foto_path')->nullable();

            $table->foreignId('agama_id')->constrained('agamas')->onDelete('restrict');
            $table->foreignId('golongan_id')->constrained('golongans')->onDelete('restrict');
            $table->foreignId('eselon_id')->constrained('eselons')->onDelete('restrict');
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('restrict');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
