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
        return BookResource::collection($books);
    }
}
