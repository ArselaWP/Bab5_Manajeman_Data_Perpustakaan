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
    Schema::create('books', function (Blueprint $table) {
        $table->id(); // Primary key [cite: 75]
        $table->string('title', 200); // Judul buku [cite: 76]
        $table->string('author', 150); // Nama penulis [cite: 77]
        $table->string('isbn', 20)->unique(); // Kode ISBN unik [cite: 78]
        $table->string('category', 100)->nullable(); // Kategori buku [cite: 79]
        $table->string('publisher', 150)->nullable(); // Nama penerbit [cite: 80]
        $table->year('year')->nullable(); // Tahun terbit [cite: 81]
        $table->integer('stock')->default(0); // Jumlah stok [cite: 82]
        $table->text('description')->nullable(); // Sinopsis [cite: 83]
        $table->timestamps(); // Created_at & Updated_at [cite: 84]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
