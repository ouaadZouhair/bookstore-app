<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'nullable|date',
            'genre' => 'required|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'language' => 'required|string|max:50',
            'publisher' => 'nullable|string|max:255',
            'available' => 'boolean',
            'price' => 'required|numeric|min:0',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book = Book::findOrFail($book->id);
        if (!$book) {
            return redirect()->route('books.index')->with('error', 'Book not found.');
        }
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'nullable|date',
            'genre' => 'required|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'language' => 'required|string|max:50',
            'publisher' => 'nullable|string|max:255',
            'available' => 'boolean',
            'price' => 'required|numeric|min:0',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
