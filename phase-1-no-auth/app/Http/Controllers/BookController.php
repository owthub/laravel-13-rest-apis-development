<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $result = Book::oldest()->get();
        // latest() -> created_at - desc
        // order_by(title, asc|desc)
        // oldest() -> created_at - asc

        return response()->json([
            'status' => true,
            'message' => 'Books listed successfully',
            'data' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        // 'title', 'author', 'isbn', 'description', 'price', 'published_year'
        // Validation - 2010, 2025, 2026,
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'isbn'  => 'nullable|string|max:20|unique:books,isbn',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'published_year' => 'nullable|integer|digits:4'
        ]);

        // Create Book
        $book = Book::create($validated);

        // Return response
        return response()->json([
            'status' => true,
            'message' => 'Book created successfully',
            'data' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Single Book Information',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book): JsonResponse
    {
        // Validation
        $validated = $request->validate([
            'title' => ['string', 'max:255', Rule::unique('books', 'title')->ignore($book->id)  ], // 'required|string|max:255|unique:books,title',
            'author' => 'string|max:255',
            'isbn'  => [ 'nullable', 'string', 'max:20', Rule::unique('books', 'isbn')->ignore($book->id) ], // 'nullable|string|max:20|unique:books,isbn',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'published_year' => 'nullable|integer|digits:4'
        ]);

        // Update
        $book->update($validated);

        // Response
        return response()->json([
            'status' => true,
            'message' => 'Book updated successfully',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully'
        ]);
    }
}