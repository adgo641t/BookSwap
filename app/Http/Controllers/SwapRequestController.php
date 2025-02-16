<?php

namespace App\Http\Controllers;

use App\Models\SwapRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;


class SwapRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $books = Book::all();
        $requestBook =  SwapRequest::where('from_user_id', auth()->id())->latest()->get();
        $allBoksUser = Book::where('user_id', auth()->id())->get();
        return view('books.adminBooks', compact('requestBook','user','books','allBoksUser'));
    }

    public function switch($id) {
        // Encuentra el libro por ID
        $book = SwapRequest::findOrFail($id);

        // Actualiza el estado del libro (por ejemplo, "Aceptado")
        $book->status = 'accepted';
        $book->save();

        // Opcionalmente, puedes redirigir a la lista de libros con un mensaje
        return redirect()->route('books.index')->with('success', 'Cambio de libro aceptado exitosamente.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {

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
