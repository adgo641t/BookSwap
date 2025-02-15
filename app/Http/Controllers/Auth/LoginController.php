<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;

class LoginController extends Controller
{
     // Mostrar el formulario de login
     public function showLoginForm()
     {
         return view('auth.login');
     }
 
     // Manejar el login
     public function login(Request $request)
     {
        $books = Book::where('status', 'available')->latest()->get();

         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
             return view('books.index', compact('books'));
         }
 
         return back()->withErrors(['email' => 'Credenciales no válidas.']);
     }
 
     // Manejar el logout
     public function logout(Request $request)
     {
         Auth::logout();
         $books = Book::where('status', 'available')->latest()->get();
        return view('books.index', compact('books'));
     }
}
