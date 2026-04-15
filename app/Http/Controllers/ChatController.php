<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // 1. Get existing chat history from session
        $history = session()->get('chat_history', []);

        // 2. Add new user message
        $history[] = [
            'role' => 'user',
            'content' => $message
        ];

        // 3. Call Gemini API with full history
        $response = Http::post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . env('GEMINI_API_KEY'),
            [
                'contents' => collect($history)->map(function ($msg) {
                    return [
                        'role' => $msg['role'] === 'user' ? 'user' : 'model',
                        'parts' => [
                            ['text' => $msg['content']]
                        ]
                    ];
                })->values()->all()
            ]
        );

        // 4. Extract AI reply safely
        $reply = $response['candidates'][0]['content']['parts'][0]['text']
            ?? 'No response';

        // 5. Add AI response to history
        $history[] = [
            'role' => 'model',
            'content' => $reply
        ];

        // 6. Save back to session
        session()->put('chat_history', $history);

        // 7. Return view
        return view('chat', compact('reply'));
    }
}
