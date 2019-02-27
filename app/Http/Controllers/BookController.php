<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Book;

class BookController extends Controller
{
    public function store(StoreBookRequest $request)
    {
        $attributes = array_except($request->validated(), 'categories');

        if (!$book = Book::create($attributes)) {
            return response('', 400);
        }

        $book->categories = $request->get('categories');

        return response($book->load('categories')->toArray(), 201);
    }
}
