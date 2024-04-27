<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __invoke()
    {
        $books = Book::paginate();
        $books->getCollection()->map(function (Book $book) {
            $book->poster = 'https://library.4w.uz' . Storage::url($book->poster);
            return $book;
        });
        return $books;
    }
}
