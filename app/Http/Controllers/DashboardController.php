<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getDashboardFirst()
    {
        $totalStudents = User::where('user_type', 'Student')->get()->count();
        $totalCategories = Category::get()->count();
        $totalAuthor = Author::all()->count();
        $totalPublisher = Publisher::get()->count();
        $totalNoOfDifferentBooks = Book::get()->count();

        $books = Book::all();

        $students = User::where('user_type', 'Student')->get();

        // $bookLoanCounts = BookLoan::select(
        //     'book_id',
        //     DB::raw('COUNT(CASE WHEN status = "borrowed" THEN 1 END) as status_borrowed'),
        //     DB::raw('COUNT(CASE WHEN status = "returned" THEN 1 END) as status_returned'),
        //     DB::raw('COUNT(CASE WHEN status = "overdue" THEN 1 END) as status_overdue')
        // )
        //     ->where('book_id', 8)
        //     ->groupBy('book_id')
        //     ->first();
        // dd($bookLoanCounts );
        return view('dashboard.dashboard_first', compact('totalStudents', 'totalCategories', 'totalAuthor', 'totalPublisher', 'totalNoOfDifferentBooks', 'books','students'));
    }
}
