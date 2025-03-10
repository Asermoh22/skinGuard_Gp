<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;

class GeminiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function askGemini(Request $request)
    {
        $message = $request->input('message');
        $response = $this->geminiService->askGemini($message);

        return response()->json($response);
    }
}
