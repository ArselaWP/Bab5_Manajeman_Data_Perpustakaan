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
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('name', 150); // Nama lengkap [cite: 94]
        $table->string('member_code', 20)->unique(); // Kode member unik [cite: 95]
        $table->string('email', 150)->unique(); // Alamat email [cite: 96, 97]
        $table->string('phone', 20)->nullable(); // Nomor telepon [cite: 98, 99]
        $table->text('address')->nullable(); // Alamat lengkap [cite: 101]
        $table->enum('status', ['active', 'inactive', 'suspended'])->default('active'); // Status [cite: 102, 103]
        $table->date('joined_at')->nullable(); // Tanggal daftar [cite: 104]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
