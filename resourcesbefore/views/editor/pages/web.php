<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\MiliarController;
use App\Http\Controllers\AuthControllerClient;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AIController;

Route::post('/generate-summary', [AIController::class, 'generateSummary']);
// Login / Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'loginCheck'])->name('login.check');
Route::get('/logout', action: [AuthController::class, 'logout'])->name('logout');
Route::prefix('translator')->controller(TranslatorController::class)->group(function () {

    Route::get('/', 'index')->name('translator.pages.index');

    Route::get('/books', 'books')->name('translator.pages.books');
    Route::get('/books/add', 'addbooks')->name('translator.pages.addbooks');
    Route::post('/books/store', 'storeBooks')->name('translator.books.store');
    Route::get('/translator/books/delete/{id}', [TranslatorController::class, 'deleteBooks'])
        ->name('translator.books.delete');
    Route::get('/article', 'article')->name('translator.pages.article');
    Route::get('/article/add', 'addArticle')->name('translator.pages.addArticle');
    Route::post('/article/store', 'storeArticle')->name('translator.article.store');
    Route::get('/translator/article/delete/{id}', [TranslatorController::class, 'deleteArticle'])
        ->name('translator.article.delete');
    Route::get('/booksPart/{id}', 'booksPart')->name('translator.pages.booksPart');
    Route::get('/bookspart/add/{id}', 'addbookspart')->name('translator.pages.addbookspart');
    Route::post('/bookspart/store', 'storebookspart')->name('translator.bookspart.store');
    Route::get('/etudes', 'etudes')->name('translator.pages.etudes');
    Route::get('/etudes/add', 'addEtudes')->name('translator.pages.addEtudes');
    Route::post('/etudes/store', 'storeEtudes')->name('translator.etudes.store');
    Route::get('/translator/etudes/delete/{id}', [TranslatorController::class, 'deleteEtudes'])
        ->name('translator.etudes.delete');

    Route::get('/etudesPart/{id}', 'etudesPart')->name('translator.pages.etudesPart');
    Route::get('/etudesPart/add/{id}', 'addetudesPart')->name('translator.pages.addetudesPart');
    Route::post('/etudesPart/store', 'storeetudesPart')->name('translator.etudesPart.store');
    Route::get('/translator/etudesPart/delete/{id}', [TranslatorController::class, 'deleteEtudesPart'])
        ->name('translator.etudesPart.delete');
    Route::get('/books-part/delete/{id}', [TranslatorController::class, 'destroy'])
        ->name('booksPart.delete');
    Route::get('/article/edit/{id}', [TranslatorController::class, 'editArticle'])
        ->name('translator.article.edit');
    Route::post('/books/updateArticle/{id}', [TranslatorController::class, 'updateArticle'])
        ->name('translator.books.updateArticle');
    Route::get('/article/view/{id}', [TranslatorController::class, 'viewArticle'])
        ->name('translator.article.view');
    Route::get('/etudes/edit/{id}', [TranslatorController::class, 'editEtudes'])
        ->name('translator.etudes.edit');

    Route::post('/books/updateEtudes/{id}', [TranslatorController::class, 'updateEtudes'])
        ->name('translator.books.updateEtudes');
    Route::get('/translator/viewetudes/{id}', [TranslatorController::class, 'viewEtudes'])
        ->name('translator.etudes.view');
    Route::get('/translator/edit/{id}', [TranslatorController::class, 'editBooks'])
        ->name('translator.books.edit');
    Route::post('/translator/update/{id}', [TranslatorController::class, 'updateBooks'])
        ->name('translator.books.update');
    Route::get('/translator/view/{id}', [TranslatorController::class, 'viewBooks'])
        ->name('translator.books.view');
});

Route::prefix('editor')->controller(EditorController::class)->group(function () {

    Route::get('/', 'index')->name('editor.pages.index');
    Route::get('/bookseditor', 'bookseditor')->name('editor.pages.bookseditor');
    Route::get('/books/edit/{id}', [EditorController::class, 'editBooks'])
        ->name('editor.books.edit');
    Route::post('/books/update/{id}', [EditorController::class, 'updateBooks'])
        ->name('editor.books.update');
    Route::get('/article/edit/{id}', [EditorController::class, 'editArticle'])
        ->name('editor.article.edit');
    Route::post('/books/updateArticle/{id}', [EditorController::class, 'updateArticle'])
        ->name('editor.books.updateArticle');
    Route::get('/articleeditor', 'articleeditor')->name('editor.pages.articleeditor');
    Route::get('/etudeseditor', 'etudeseditor')->name('editor.pages.etudeseditor');
    Route::get('/etudes/edit/{id}', [EditorController::class, 'editEtudes'])
        ->name('editor.etudes.edit');
    Route::post('/books/updateEtudes/{id}', [EditorController::class, 'updateEtudes'])
        ->name('editor.books.updateEtudes');
    Route::get('/article/view/{id}', [EditorController::class, 'viewArticle'])
        ->name('editor.article.view');
});

Route::prefix('admin')->controller(AdminController::class)->group(function () {

    Route::get('/', 'index')->name('superAdmin.pages.index');
    Route::get('/books', 'books')->name('superAdmin.pages.books');
    Route::get('/books/delete/{id}', [AdminController::class, 'deletebooks'])
        ->name('books.delete');
    Route::post('/books/publish/{id}', [AdminController::class, 'publish'])->name('books.publish');
    Route::get('/banner', 'banner')->name('superAdmin.pages.banner');
    Route::get('/banner/addbanner', 'addbanner')->name('superAdmin.pages.addbanner');
    Route::get('/banner/delete/{id}', [AdminController::class, 'deletebanner'])
        ->name('banner.delete');
    Route::post('/banner/store', 'storebanner')->name('superAdmin.banner.store');
    Route::get('/category', 'category')->name('superAdmin.pages.category');
    Route::get('/category/addcategory', 'addcategory')->name('superAdmin.pages.addcategory');
    Route::post('/category/store', 'storecategory')->name('superAdmin.category.store');
    Route::get('/category/delete/{id}', [AdminController::class, 'deletecategory'])
        ->name('category.delete');
    Route::get('/article', 'article')->name('superAdmin.pages.article');
    Route::get('/article/add', 'addArticle')->name('superAdmin.pages.addArticle');
    Route::post('/article/store', 'storeArticle')->name('superAdmin.article.store');
    Route::get('/books/add', 'addbooks')->name('superAdmin.pages.addbooks');
    Route::post('/books/store', 'storeBooks')->name('superAdmin.books.store');
    Route::get('/translatorList', 'translatorList')->name('superAdmin.pages.translatorList');
    Route::get('/addtranslatorList', 'addtranslatorList')->name('superAdmin.pages.addtranslatorList');
    Route::post('/addtranslatorList/store', 'storetranslatorList')->name('superAdmin.addtranslatorList.store');
    Route::get('/translator/delete/{id}', [AdminController::class, 'deletetranslatorList'])
        ->name('translator.delete');
    Route::get('/etudes', 'etudes')->name('superAdmin.pages.etudes');

    Route::get('/article/add', 'addArticle')->name('superAdmin.pages.addArticle');
    Route::post('/article/store', 'storeArticle')->name('superAdmin.article.store');
    Route::get('/etudes/add', 'addEtudes')->name('superAdmin.pages.addEtudes');
    Route::post('/etudes/store', 'storeEtudes')->name('superAdmin.etudes.store');

    //lors de partage update et la suppression des posts deja partagé
    Route::get('/listePublier', 'listePublier')->name('superAdmin.pages.listePublier');

    Route::get('/books', 'allBooks')->name('superAdmin.pages.allBooks');
    Route::get('/books/deleteall/{id}', [AdminController::class, 'deleteallbooks'])
        ->name('books.deleteall');


    Route::get('/booksPart/{id}', 'booksPart')->name('superAdmin.pages.booksPart');
    Route::get('/bookspart/add/{id}', 'addbookspart')->name('superAdmin.pages.addbookspart');
    Route::post('/bookspart/store', 'storebookspart')->name('superAdmin.bookspart.store');
});

Route::get('/', [MiliarController::class, 'index'])->name('miliar.index');
Route::get('/indexProp2', [MiliarController::class, 'indexProp2'])->name('miliar.indexProp2');
Route::get('/translatorweb', [MiliarController::class, 'translatorweb'])->name('miliar.translatorweb');
Route::get('/translatorDetails/{id}', [MiliarController::class, 'translatorDetails'])->name('miliar.translatorDetails');
Route::get('/books', [MiliarController::class, 'books'])->name('miliar.books');
Route::get('/books1', [MiliarController::class, 'books1'])->name('miliar.books1');

Route::get('/about', [MiliarController::class, 'about'])->name('miliar.about');
Route::get('/contact', [MiliarController::class, 'contact'])->name('miliar.contact');
Route::get('/elementor', [MiliarController::class, 'elementor'])->name('miliar.elementor');
// Route AJAX pour le select
Route::get('/search-translators', [MiliarController::class, 'searchTranslators'])->name('search.translators');
// Route avec paramètre {id}
Route::get('/booksDetails/{id}', [MiliarController::class, 'booksDetails'])->name('miliar.booksDetails');
Route::get('/booksDetails1/{id}', [MiliarController::class, 'booksDetails1'])->name('miliar.booksDetails1');
Route::get('/booksPartDetails/{id}', [MiliarController::class, 'booksPartDetails'])->name('miliar.booksPartDetails');
Route::get('/etudesPartDetails/{id}', [MiliarController::class, 'etudesPartDetails'])->name('miliar.etudesPartDetails');

Route::get('/inscription', [MiliarController::class, 'inscription'])->name('miliar.inscription');
Route::get('/register', [MiliarController::class, 'register'])->name('miliar.register');
Route::get('/super-admin/books', [AdminController::class, 'books'])
    ->name('superAdmin.pages.books');
Route::get('/category/{category}', [MiliarController::class, 'categoryID'])
    ->name('miliar.categoryID');



Route::post('/loginClient', [AuthControllerClient::class, 'loginClient'])
    ->name('loginClient');
Route::get('/logoutClient', [AuthControllerClient::class, 'logoutClient'])
    ->name('logoutClient');
Route::post('/register-client', [AuthControllerClient::class, 'registerClient'])
    ->name('registerClient');



Route::get('/favoris', [ClientController::class, 'favoris'])->name('client.pages.favoris');
Route::post('/add-favoris', [ClientController::class, 'addFavoris'])
    ->name('addFavoris');
Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('client/indexProp2', [ClientController::class, 'indexProp2'])->name('client.indexProp2');
Route::get('client/translatorweb', [ClientController::class, 'translatorweb'])->name('client.translatorweb');
Route::get('client/translatorDetails/{id}', [ClientController::class, 'translatorDetails'])->name('client.translatorDetails');
Route::get('client/books', [ClientController::class, 'books'])->name('client.books');
Route::get('client/about', [ClientController::class, 'about'])->name('client.about');
Route::get('client/contact', [ClientController::class, 'contact'])->name('client.contact');
Route::get('client/elementor', [ClientController::class, 'elementor'])->name('client.elementor');
// Route AJAX pour le select
Route::get('client/search-translators', [ClientController::class, 'searchTranslators'])->name('client.search.translators');
// Route avec paramètre {id}
Route::get('client/booksDetails/{id}', [ClientController::class, 'booksDetails'])->name('client.booksDetails');
Route::get('client/booksPartDetails/{id}', [ClientController::class, 'booksPartDetails'])->name('client.booksPartDetails');
Route::get('client/etudesPartDetails/{id}', [ClientController::class, 'etudesPartDetails'])->name('client.etudesPartDetails');

Route::get('client/category/{category}', [ClientController::class, 'categoryID'])
    ->name('client.categoryID');