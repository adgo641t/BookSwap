<?php

namespace App\Http\Controllers;

use App\Models\SwapRequest;
use Illuminate\Http\Request;
use App\Models\Book;

class SwapRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        if ($book->user_id === auth()->id()) {
            return redirect()->back()->with('error', 'No puedes intercambiar tu propio libro.');
        }

        SwapRequest::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $book->user_id,
            'book_id' => $book->id,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Solicitud de intercambio enviada.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(SwapRequest $swapRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SwapRequest $swapRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SwapRequest $swapRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SwapRequest $swapRequest)
    {
        //
    }
}
