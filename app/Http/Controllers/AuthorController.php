<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Author::all(); // User::get();
        return view('library.author.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('library.author.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validateData =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nationality' => ['integer', 'required'],
            'birth_date' => ['string', 'required'],
            'death_date' => ['nullable'],
            'biography' => ['nullable'],
            'photo' => ['required'],
        ]);


        if ($request->photo) {
            // Store file in "storage/app/public"
            $path = $request->file('photo')->store('uploads', 'public');
            $validateData['photo'] = $path;
        }

        // dd($validateData);
        Author::create($validateData);
        return redirect()->route('authors.index')->with('status', 'author data stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(author $author)
    {
        $countries = DB::table('countries')->get();
        return view('library.author.edit', compact('countries', 'author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, author $author)
    {
        $validateData =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nationality' => ['integer', 'required'],
            'birth_date' => ['string', 'required'],
            'death_date' => ['nullable'],
            'biography' => ['nullable'],
            'photo' => ['required'],
        ]);


        if ($request->photo) {
            // Check if an old file exists and delete it
            if (!empty($author['photo']) && Storage::disk('public')->exists($author['photo'])) {
                Storage::disk('public')->delete($author['photo']);
            }
            // Store new file in "storage/app/public/uploads"
            $path = $request->file('photo')->store('uploads', 'public');
            $validateData['photo'] = $path;
        }


        // dd($validateData);
        $author->update($validateData);
        return redirect()->route('authors.index')->with('status', 'author data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(author $author)
    {
        if (!empty($author['photo']) && Storage::disk('public')->exists($author['photo'])) {
            Storage::disk('public')->delete($author['photo']);
        }
        $author->delete();
        return redirect()->route('authors.index')->with('status', 'author data deleted successfully.');
    }
}
