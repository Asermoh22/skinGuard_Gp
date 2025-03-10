<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
{
    $this->apiKey = env('GEMINI_API_KEY');
    // Debug the API key
    \Log::debug('Gemini API Key: ' . $this->apiKey); // Log the key to make sure it's set
}
    public function askGemini($message)
    {
        $apiKey = $this->apiKey;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $message, // Still include 'text' for backward compatibility.
                            'data' => [ // The crucial 'data' field.
                                'text' => $message,  // Specify that the data is text.
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            \Log::error($response->status() . ': ' . $response->body());
            return response()->json(['error' => 'Error communicating with Gemini API'], $response->status());
        }
    }
}