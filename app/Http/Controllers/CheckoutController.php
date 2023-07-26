<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Checkout;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    //This endpoint should check out a book for a user. The request body should contain a user ID and a book ID. It should reduce the number of available copies of the book.

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->copies <= 0) {
            throw ValidationException::withMessages(['book_id' => 'Book is not available for checkout']);
        }

        $checkout = Checkout::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'checkout_date' => now()->toDateString(),
        ]);

        $book->decrement('copies');

        return response()->json(['message' => 'Book checked out successfully', 'data' => $checkout]);
    }
    //This endpoint should mark a book as returned by a user. It should increase the number of available copies of the book.
    public function update(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $checkout = Checkout::findOrFail($id);

        if ($checkout->return_date !== null) {
            throw ValidationException::withMessages(['return_date' => 'Book has already been returned']);
        }

        $checkout->update([
            'return_date' => $request->return_date,
        ]);

        $book = Book::findOrFail($checkout->book_id);
        $book->increment('copies');

        return response()->json(['message' => 'Book marked as returned successfully']);
    }
}
