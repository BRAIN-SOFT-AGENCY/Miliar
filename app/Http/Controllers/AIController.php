<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    /* public function generateSummary(Request $request)
     {
         try {

             $article = strip_tags($request->article);
             $apiKey = env('GEMINI_API_KEY');

             $response = Http::post(
                 "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=$apiKey",
                 [
                     "contents" => [
                         [
                             "parts" => [
                                 [
                                     "text" => "لخص هذا المقال بالعربية:\n\n" . strip_tags($request->article)
                                 ]
                             ]
                         ]
                     ]
                 ]
             );
             $data = $response->json();

             if (isset($data['error'])) {
                 return response()->json([
                     'error' => $data['error']['message'],
                     'full' => $data
                 ], 500);
             }

             return response()->json([
                 'summary' => $data['candidates'][0]['content']['parts'][0]['text']
             ]);



             if (!$summary) {
                 return response()->json([
                     'error' => 'Invalid Gemini response',
                     'debug' => $data
                 ], 500);
             }

             return response()->json([
                 'summary' => $summary
             ]);

         } catch (\Exception $e) {

             return response()->json([
                 'error' => $e->getMessage()
             ], 500);
         }
     }*/
    /*  public function generateSummary(Request $request)
      {
          try {

              $article = strip_tags($request->article);

              if (empty($article)) {
                  return response()->json([
                      'error' => 'Article vide'
                  ], 400);
              }

              $apiKey = env('GEMINI_API_KEY');

              $response = Http::timeout(120)->post(
                  "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
                  [
                      "contents" => [
                          [
                              "parts" => [
                                  [
                                      "text" => "لخص هذا المقال بالعربية:\n\n" . $article
                                  ]
                              ]
                          ]
                      ]
                  ]
              );

              $data = $response->json();

              if (!$response->successful()) {
                  return response()->json([
                      'error' => 'Gemini Error',
                      'status' => $response->status(),
                      'response' => $data
                  ], 500);
              }

              $summary = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';

              if (empty($summary)) {
                  return response()->json([
                      'error' => 'Résumé non généré',
                      'debug' => $data
                  ], 500);
              }

              return response()->json([
                  'summary' => $summary
              ]);

          } catch (\Exception $e) {

              return response()->json([
                  'error' => $e->getMessage()
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
    }
}