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
        Schema::create('m_employees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Kode karyawan, agar user mudah mengidentifikasi karyawan. Digenerate secara otomatis dari controller, agar tidak perlu diisi manual');
            $table->string('username')->unique()->comment('Username karyawan');
            $table->string('password')->comment('Password karyawan');
            $table->string('name')->comment('Nama lengkap karyawan');
            $table->string('email')->unique()->comment('Email karyawan');
            $table->string('phone')->nullable()->comment('Nomor telepon karyawan');
            $table->string('address')->nullable()->comment('Alamat karyawan');
            $table->string('photo')->nullable()->comment('Foto karyawan');
            $table->string('position')->nullable()->comment('Jabatan karyawan');
            $table->enum('role', ['admin', 'employee'])->default('employee')->comment('Role karyawan, admin atau employee');
            $table->timestamp('last_login')->nullable()->comment('Waktu terakhir karyawan login ke sistem');
            $table->rememberToken();
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_employees');
        Schema::dropIfExists('sessions');
    }
};
