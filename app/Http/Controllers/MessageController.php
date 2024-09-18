<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255', // Add validation for subject
            'message' => 'required|string|max:1000',
        ]);

        // Prepare the data
        $data = "Name: " . $request->name . "\n" .
                "Email: " . $request->email . "\n" .
                "Subject: " . $request->subject . "\n" . // Add subject to the data
                "Message: " . $request->message . "\n\n";

        // Define the file path where the messages will be stored
        $filePath = storage_path('app/messages.txt');

        // Append the data to the file
        File::append($filePath, $data);

        // Redirect back with a success message
        return back()->with('success', 'Your message has been saved successfully.');
    }
}
