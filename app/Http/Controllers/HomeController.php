<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function redirect()
    {
        $user = Auth::user();
            return redirect()->route('user.home');
    }
    public function index()
    {
        $user = Auth::user();
            return view('user.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function storeMessage(Request $request)
    {
        // Get form data
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Create the content to write to the file
        $content = "Name: $name\nEmail: $email\nMessage: $message\n---\n";

        // Define file path (directly inside the app directory)
        $filePath = base_path('app/messages.txt');

        // Append content to the file
        file_put_contents($filePath, $content, FILE_APPEND);

        return back()->with('success', 'Message stored successfully!');
    }
    
}
