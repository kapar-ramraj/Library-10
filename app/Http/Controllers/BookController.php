<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Book::join('authors', 'authors.id', 'books.author_id')
            ->join('publishers', 'publishers.id', 'books.publisher_id')
            ->join('categories', 'categories.id', 'books.category_id')
            ->select('books.*', 'authors.name as author_name', 'publishers.name as publisher_name', 'categories.name as category_name')
            ->get();
        // dd($items);
        return view('library.book.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();
        // dd($categories);
        return view('library.book.create', compact('categories', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validateData =  $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'unique:books', 'max:255'],
            'author_id' => ['integer', 'required'],
            'publisher_id' => ['integer', 'required'],
            'category_id' => ['integer', 'required'],
            'publication_year' => ['integer', 'required'],
            'quantity' => ['integer', 'required'],
            'description' => ['nullable'],
            'cover_image' => ['nullable']
        ]);

        // dd($validateData);
        if ($request->cover_image) {
            // Store file in "storage/app/public"
            $path = $request->file('cover_image')->store('uploads', 'public');
            $validateData['cover_image'] = $path;
        }

        // dd($validateData);
        Book::create($validateData);
        return redirect()->route('books.index')->with('status', 'book data stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // dd($book->author->name);
        $categories = Category::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();
        return view('library.book.edit', compact('categories', 'authors', 'publishers', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validateData =  $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'max:255', Rule::unique('books')->ignore($book->id)],
            'author_id' => ['integer', 'required'],
            'publisher_id' => ['integer', 'required'],
            'category_id' => ['integer', 'required'],
            'publication_year' => ['integer', 'required'],
            'quantity' => ['integer', 'required'],
            'description' => ['nullable'],
            'cover_image' => ['nullable']
        ]);

        // dd($validateData);
        if ($request->cover_image) {
            if (!empty($book['cover_image']) && Storage::disk('public')->exists($book['cover_image'])) {
                Storage::disk('public')->delete($book['cover_image']);
            }
            // Store file in "storage/app/public"
            $path = $request->file('cover_image')->store('uploads', 'public');
            $validateData['cover_image'] = $path;
        }

        // dd($validateData);
        $book->update($validateData);
        return redirect()->route('books.index')->with('status', 'Book data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // dd($book->loans);
        if (count($book->loans) > 0 ) {
            return response()->json(['success' => false, 'message' => "You won't able to delete this book record because its related child records exists."], 200);
        } else {
            if (!empty($book['cover_image']) && Storage::disk('public')->exists($book['cover_image'])) {
                Storage::disk('public')->delete($book['cover_image']);
            }
            $book->delete();
            return response()->json(['success' => true], 200);
        }
    }
}
