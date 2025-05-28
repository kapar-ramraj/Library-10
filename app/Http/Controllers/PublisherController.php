<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Publisher::all(); // User::get();
        return view('library.publisher.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('library.publisher.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validateData =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['integer', 'required'],
            'city' => ['string', 'required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:publishers'],
            'phone' => ['required'],
            'website' => ['nullable', 'max:255'],
            'address' => ['required', 'max:255'],
        ]);

        // dd($validateData);
        Publisher::create($validateData);
        return redirect()->route('publishers.index')->with('status', 'Publisher data stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        $countries = DB::table('countries')->get();
        return view('library.publisher.edit', compact('countries', 'publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        // dd($request->all(), $publisher);
        $validateData =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'country' => ['integer', 'required'],
            'city' => ['string', 'required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('publishers')->ignore($publisher->id)],
            'phone' => ['required'],
            'website' => ['nullable', 'max:255'],
            'address' => ['required', 'max:255']
        ]);
        $publisher->update($validateData);
        return redirect()->route('publishers.index')->with('status', 'Publisher data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('publishers.index')->with('status', 'Publisher data deleted successfully.');
    }
}
