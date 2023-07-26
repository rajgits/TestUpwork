<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'published_at' => 'required|date',
            'copies' => 'required|integer|min:0',
        ]);

        $book = Book::create($request->all());
        return response()->json(['message' => 'Book added successfully', 'data' => $book]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $id,
            'published_at' => 'required|date',
            'copies' => 'required|integer|min:0',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json(['message' => 'Book updated successfully', 'data' => $book]);
    }
    
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
