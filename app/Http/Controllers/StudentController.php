<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getProfile()
    {
        // $user = auth()->user();
        $user = Auth::user();

        $bookLoans = BookLoan::where('user_id', $user->id)->get();
        
        $authUserBookStatus = BookLoan::select(
            'user_id',
            DB::raw('COUNT(CASE WHEN status = "borrowed" THEN 1 END) as status_borrowed'),
            DB::raw('COUNT(CASE WHEN status = "returned" THEN 1 END) as status_returned'),
            DB::raw('COUNT(CASE WHEN status = "overdue" THEN 1 END) as status_overdue')
        )
            ->where('user_id', $user->id)
            ->groupBy('user_id')
            ->first();
        // dd($authUserBookStatus);
        return view('student.student_profile', compact('user', 'bookLoans', 'authUserBookStatus'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        //Upload actual file or image
        //store the link.

        // Validate file
        $request->validate([
            'file' => 'file|max:5048', // max 2MB
        ]);

        $userData = $request->all();
        if ($request->student_profile) {
            // Store file in "storage/app/public"
            $path = $request->file('student_profile')->store('uploads', 'public');
            $userData['profile'] = $path;
        }
        auth()->user()->update($userData);

        return redirect()->back()->with('success', 'Your profile updated successfully.');
    }
}
