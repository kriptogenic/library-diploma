<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __invoke()
    {
        return Book::paginate()->map(function (Book $book) {
            return [
                ...$book->toArray(),
                'poster' => Storage::url($book->poster)
            ];
        });
    }
}
