<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class GeminiChatController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $prompt = $request->input('message');

            // Pastikan kamu sudah set GEMINI_API_KEY di .env
            $apiKey = env('GEMINI_API_KEY');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}";

            $response = Http::post($url, [
                'contents' => [
                    ['parts' => [['text' => $prompt]]],
                ],
            ]);

            // Cek apakah request gagal
            if ($response->failed()) {
                Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return response()->json([
                    'reply' => 'Gagal menghubungi layanan Gemini.'
                ], 500);
            }

            // Ambil hasil respon
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada respons dari Gemini.';

            return response()->json([
                'reply' => $reply
            ]);
        } catch (Throwable $e) {
            Log::error('GeminiChat Error', ['error' => $e->getMessage()]);
            return response()->json([
                'reply' => 'Terjadi kesalahan di server.'
            ], 500);
        }
    }
}
