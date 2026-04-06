<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    // 1. Menampilkan Semua Buku
    public function index()
    {
        $books = Book::all();
        return BookResource::collection($books)->additional([
            'success' => true,
            'message' => 'Daftar data buku berhasil diambil'
        ]);
    }

    // 2. Menambah Buku Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|max:200',
            'author'    => 'required|max:150',
            'isbn'      => 'required|unique:books,isbn',
            'category'  => 'nullable',
            'stock'     => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $book = Book::create($request->all());

        return (new BookResource($book))->additional([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan'
        ])->response()->setStatusCode(201); // 201 = Created
    }

    // 3. Detail Buku
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return (new BookResource($book))->additional([
            'success' => true,
            'message' => 'Detail buku ditemukan'
        ]);
    }

    // 4. Update Buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $book->update($request->all());

        return (new BookResource($book))->additional([
            'success' => true,
            'message' => 'Data buku berhasil diperbarui'
        ]);
    }

    // 5. Hapus Buku (Tugas Khusus Logic)
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // LOGIC: Cek stok sesuai Modul
        if ($book->stock > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus! Stok buku [' . $book->title . '] masih tersedia ' . $book->stock . ' buah.'
            ], 422);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus dari sistem'
        ], 200);
    }
}
