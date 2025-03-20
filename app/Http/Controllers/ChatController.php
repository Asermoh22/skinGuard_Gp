<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        try {
            // Call Flask API
            $response = Http::post('http://127.0.0.1:5001/chat', [
                'message' => $validatedData['message'],
            ]);

            // Check if request was successful
            if ($response->successful()) {
                return response()->json(['response' => $response->json()['response']]);
            } else {
                return response()->json(['error' => 'API Error'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to connect to API'], 500);
        }
    }
}
