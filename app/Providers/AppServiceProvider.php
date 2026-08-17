<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Book;
use App\Models\Translator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    /*public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('categories', Category::all());
        });
    }
*/
    public function boot()
    {
        View::composer('*', function ($view) {

            // Catégories disponibles partout
            $categories = Category::where('isActive', 1)->get();


            // Notifications livres non publiés admin 
            $articleCount = Book::where('status', -2)
                ->where('type', 0)
                ->count();


            $etudesCount = Book::where('status', -2)
                ->where('type', 2)
                ->count();

            $booksCount = Book::where('status', -2)
                ->where('type', 1)
                ->count();

            // end  Notifications livres non publiés admin 



            // Notifications livres non publiés editor 
            $articleCounteditor = Book::where('status', -1)
                ->where('type', 0)
                ->count();


            $etudesCounteditor = Book::where('status', -1)
                ->where('type', 2)
                ->count();

            $booksCounteditor = Book::where('status', -1)
                ->where('type', 1)
                ->count();

            // end  Notifications livres non publiés editor 
//translator count waitting
            $translatorcountAdmin = Translator::where('translatorStatus', 0)
                ->count();

            $view->with([
                'categories' => $categories,
                'articleCount' => $articleCount,
                'etudesCount' => $etudesCount,
                'booksCount' => $booksCount,
                'articleCounteditor' => $articleCounteditor,
                'etudesCounteditor' => $etudesCounteditor,
                'booksCounteditor' => $booksCounteditor,
                'translatorcountAdmin' => $translatorcountAdmin
            ]);

        });
    }



}
