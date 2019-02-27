<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookSearchController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => ['nullable', 'string'],
            'category' => ['nullable', 'string']
        ]);

        $query = Book::where(array_except($validated, 'category'))
        ->ofCategory(array_get($validated, 'category'));

        return $query->get();
    }
}
