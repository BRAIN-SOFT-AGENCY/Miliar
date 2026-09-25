<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookspart;
use App\Models\etudespart;
use Illuminate\Http\JsonResponse;

class WordCountController extends Controller
{
    private function countWords(?string $html): int
    {
        if ($html === null || $html === '') {
            return 0;
        }

        $text = html_entity_decode(
            strip_tags($html),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );

        $words = preg_match_all(
            '/[\p{L}\p{N}]+(?:[\x{2019}\'-][\p{L}\p{N}]+)*/u',
            $text
        );

        return $words === false ? 0 : $words;
    }

    private function countBookFields(Book $book): int
    {
        $total = 0;

        foreach (['article', 'ResumeLivre', 'extrait', 'Titre'] as $field) {
            $total += $this->countWords($book->{$field});
        }

        if ((int) $book->type === 0) {
            $parts = Bookspart::where('booksID', $book->booksID)
                ->get(['booksPartTitre', 'bookspartResumeLivre', 'bookpartarticle']);

            foreach ($parts as $part) {
                foreach (['booksPartTitre', 'bookspartResumeLivre', 'bookpartarticle'] as $field) {
                    $total += $this->countWords($part->{$field});
                }
            }
        } elseif ((int) $book->type === 2) {
            $parts = etudespart::where('booksID', $book->booksID)
                ->get(['etudespartTitre', 'etudespartarticle', 'etudespartResumeLivre']);

            foreach ($parts as $part) {
                foreach (['etudespartTitre', 'etudespartarticle', 'etudespartResumeLivre'] as $field) {
                    $total += $this->countWords($part->{$field});
                }
            }
        }

        return $total;
    }

    public function countAllBooks(): JsonResponse
    {
        $totalWords = 0;
        $details = [];

        Book::where('status', 0)
            ->select('booksID', 'type', 'article', 'ResumeLivre', 'extrait', 'Titre')
            ->chunkById(100, function ($books) use (&$totalWords, &$details) {
                foreach ($books as $book) {
                    $bookWordCount = $this->countBookFields($book);
                    $totalWords += $bookWordCount;
                    $details[] = [
                        'booksID' => $book->booksID,
                        'type' => $book->type,
                        'words' => $bookWordCount,
                    ];
                }
            }, 'booksID');

        return response()->json([
            'total_words' => $totalWords,
            'books_count' => count($details),
            'details' => $details,
        ]);
    }

    /*public function countOneBook(int $booksID): JsonResponse
    {
        $book = Book::where('booksID', $booksID)
            ->select('booksID', 'type', 'article', 'ResumeLivre', 'extrait', 'Titre')
            ->firstOrFail();

        return response()->json([
            'booksID' => $book->booksID,
            'type' => $book->type,
            'total_words_and_spaces' => $this->countBookFields($book),
        ]);
    }*/

    public function countAllBookscar(): JsonResponse
    {
        $totalWords = 0;
        $details = [];
        Book::where('status', 0)->select('booksID', 'type', 'article', 'ResumeLivre', 'extrait', 'Titre')->chunkById(100, function ($books) use (&$totalWords, &$details) {
            $bookIds = $books->pluck('booksID');
            $bookParts = Bookspart::whereIn('booksID', $bookIds)->get(['booksID', 'booksPartTitre', 'bookspartResumeLivre', 'bookpartarticle'])->groupBy('booksID');
            $studyParts = etudespart::whereIn('booksID', $bookIds)->get(['booksID', 'etudespartTitre', 'etudespartarticle', 'etudespartResumeLivre'])->groupBy('booksID');
            foreach ($books as $book) {
                $bookWordCount = 0;
                foreach (['article', 'ResumeLivre', 'extrait', 'Titre'] as $field) {
                    $text = $book->{$field};
                    if (!empty($text)) {
                        $text = strip_tags($text);
                        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
                        $text = preg_replace('/\s+/u', ' ', $text);
                        $text = trim($text);
                        if ($text !== '') {
                            preg_match_all('/[\p{L}\p{N}]+|[^\p{L}\p{N}\s]/u', $text, $matches);
                            $bookWordCount += count($matches[0]);
                        }
                    }
                }$parts = (int) $book->type === 0 ? $bookParts->get($book->booksID, collect()) : ((int) $book->type === 2 ? $studyParts->get($book->booksID, collect()) : collect());
                $partsFields = (int) $book->type === 0 ? ['booksPartTitre', 'bookspartResumeLivre', 'bookpartarticle'] : ['etudespartTitre', 'etudespartarticle', 'etudespartResumeLivre'];
                foreach ($parts as $part) {
                    foreach ($partsFields as $field) {
                        $text = $part->{$field};
                        if (!empty($text)) {
                            $text = strip_tags($text);
                            $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
                            $text = preg_replace('/\s+/u', ' ', $text);
                            $text = trim($text);
                            if ($text !== '') {
                                preg_match_all('/[\p{L}\p{N}]+|[^\p{L}\p{N}\s]/u', $text, $matches);
                                $bookWordCount += count($matches[0]);
                            }
                        }
                    }
                }$totalWords += $bookWordCount;
                $details[] = ['booksID' => $book->booksID, 'type' => $book->type, 'words' => $bookWordCount,];
            }
        }, 'booksID');
        return response()->json(['total_words' => $totalWords, 'books_count' => count($details), 'details' => $details,]);
    }



    
}
