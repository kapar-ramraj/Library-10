<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookLoan;
use App\Models\User;
use App\Rules\BookLoanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all(), $request->book_id);
        $query = BookLoan::query();
        if ($request->book_id) {
            $query->where('book_id', $request->book_id);
        }

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $items = $query->get();
        return view('library.book-loan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::select('id', 'title')->get();
        $students = User::where('user_type', 'Student')->get();
        return view('library.book-loan.create', compact('books', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validateData =  $request->validate([
            'book_id' => [
                'integer',
                'required',
                new BookLoanStatus($request->user_id, $request->status),
            ],
            'user_id' => ['integer', 'required'],
            'loan_date' => ['date', 'required'],
            'due_date' => ['date', 'required'],
            'return_date' => ['nullable'],
            'status' => ['required'],
            'notes' => ['nullable'],
        ]);


        // dd($validateData);
        BookLoan::create($validateData);
        return redirect()->route('book-loans.index')->with('status', 'book data stored successfully.');
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
    public function edit(BookLoan $bookLoan, Request $request)
    {
        // dd($bookLoan);
        $books = Book::select('id', 'title')->get();
        $students = User::where('user_type', 'Student')->get();
        // dd($students);
        return view('library.book-loan.edit', compact('books', 'students', 'bookLoan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookLoan $bookLoan)
    {
        // dd($request->all());
        $validateData =  $request->validate([
            'book_id' => [
                'integer',
                'required',
                new BookLoanStatus($request->user_id, $request->status),
            ],
            'user_id' => ['integer', 'required'],
            'loan_date' => ['date', 'required'],
            'due_date' => ['date', 'required'],
            'return_date' => ['nullable'],
            'status' => ['required'],
            'notes' => ['nullable'],
        ]);

        $bookLoan->update($validateData);
        return redirect('book-loans'.'?'.$request->queryString)->with('status', 'Book data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookLoan $bookLoan)
    {
        if ($bookLoan->created_at->isToday()) {
            $bookLoan->delete();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false, 'message' => "you don't able to delete this record because it is older date."], 200);
        }
    }
}
