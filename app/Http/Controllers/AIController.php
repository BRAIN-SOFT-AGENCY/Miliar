<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{

    /* public function generateSummary(Request $request)
     {
         try {

             $article = trim(strip_tags($request->article));

             if (empty($article)) {
                 return response()->json([
                     'error' => 'الرجاء إدخال نص الكتاب'
                 ], 400);
             }

             $apiKey = env('GEMINI_API_KEY');

             if (empty($apiKey)) {
                 return response()->json([
                     'error' => 'Gemini API Key not configured'
                 ], 500);
             }

             $payload = [
                 "contents" => [
                     [
                         "parts" => [
                             [
                                 "text" => "لخص هذا الكتاب باللغة العربية في فقرة واضحة ومختصرة:\n\n" . $article
                             ]
                         ]
                     ]
                 ]
             ];

             $maxAttempts = 3;
             $response = null;

             for ($i = 1; $i <= $maxAttempts; $i++) {

                 $response = Http::timeout(120)
                     ->acceptJson()
                     ->post(
                         "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                         $payload
                     );

                 if ($response->successful()) {
                     break;
                 }

                 // Réessayer uniquement pour surcharge ou quota temporaire
                 if (in_array($response->status(), [429, 500, 503])) {
                     sleep(2);
                     continue;
                 }

                 break;
             }

             if (!$response || !$response->successful()) {

                 $body = $response ? $response->json() : [];

                 return response()->json([
                     'error' => $body['error']['message']
                         ?? 'تعذر الاتصال بخدمة الذكاء الاصطناعي'
                 ], 500);
             }

             $data = $response->json();

             $summary = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

             if (empty($summary)) {

                 return response()->json([
                     'error' => 'لم يتمكن Gemini من إنشاء الملخص'
                 ], 500);
             }

             return response()->json([
                 'summary' => trim($summary)
             ]);

         } catch (\Throwable $e) {

             \Log::error('Gemini Error: ' . $e->getMessage());

             return response()->json([
                 'error' => 'حدث خطأ أثناء إنشاء الملخص'
             ], 500);
         }
     }*/


    public function generateSummary(Request $request)
    {
        try {

            $article = trim(strip_tags($request->article));

            if (empty($article)) {
                return response()->json([
                    'error' => 'الرجاء إدخال نص الكتاب'
                ], 400);
            }

            $apiKey = env('GEMINI_API_KEY');

            if (empty($apiKey)) {
                return response()->json([
                    'error' => 'Gemini API Key not configured'
                ], 500);
            }

            $payload = [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => "لخص هذا الكتاب باللغة العربية في فقرة واضحة ومختصرة:\n\n" . $article
                            ]
                        ]
                    ]
                ]
            ];

            $maxAttempts = 3;
            $response = null;

            for ($i = 1; $i <= $maxAttempts; $i++) {

                $response = Http::timeout(120)
                    ->acceptJson()
                    ->post(
                        "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                        $payload
                    );

                // Succès
                if ($response->successful()) {
                    break;
                }

                // Quota dépassé
                if ($response->status() === 429) {

                    \Log::warning(
                        'Gemini quota exceeded: ' . $response->body()
                    );

                    return response()->json([
                        'error' => 'تم تجاوز الحد المسموح به لاستخدام الذكاء الاصطناعي. يرجى المحاولة لاحقًا.'
                    ], 429);
                }

                // Erreurs temporaires
                if (in_array($response->status(), [500, 503])) {

                    sleep(2);

                    continue;
                }

                // Autre erreur
                break;
            }


            /*
            |--------------------------------------------------------------------------
            | Vérifier la réponse
            |--------------------------------------------------------------------------
            */

            if (!$response || !$response->successful()) {

                $body = $response ? $response->json() : [];

                return response()->json([
                    'error' => $body['error']['message']
                        ?? 'تعذر الاتصال بخدمة الذكاء الاصطناعي'
                ], $response ? $response->status() : 500);
            }


            /*
            |--------------------------------------------------------------------------
            | Récupérer les données Gemini
            |--------------------------------------------------------------------------
            */

            $data = $response->json();

            $summary =
                $data['candidates'][0]['content']['parts'][0]['text']
                ?? '';


            /*
            |--------------------------------------------------------------------------
            | Vérifier le résumé
            |--------------------------------------------------------------------------
            */

            if (empty($summary)) {

                return response()->json([
                    'error' => 'لم يتمكن Gemini من إنشاء الملخص'
                ], 500);
            }


            /*
            |--------------------------------------------------------------------------
            | Retourner le résumé
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'summary' => trim($summary)
            ]);


        } catch (\Throwable $e) {

            \Log::error(
                'Gemini Error: ' . $e->getMessage()
            );

            return response()->json([
                'error' => 'حدث خطأ أثناء إنشاء الملخص'
            ], 500);
        }
    }



}