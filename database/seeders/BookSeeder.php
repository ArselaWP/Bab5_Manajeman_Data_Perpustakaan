<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '978-0132350884',
                'category' => 'Programming',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'stock' => 5,
                'description' => 'Panduan menulis kode yang bersih.'
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt & David Thomas',
                'isbn' => '978-0201616224',
                'category' => 'Programming',
                'publisher' => 'Addison-Wesley',
                'year' => 1999,
                'stock' => 3,
                'description' => 'Panduan praktis menjadi programmer profesional.'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
