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
use App\Http\Controllers\ForgotPasswordController;

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



    Route::get('/viewbooksPart/{id}', [TranslatorController::class, 'viewetudesPart'])
        ->name('translator.etudesPart.view');
    Route::get('/translator/editetudesPart/{id}', [TranslatorController::class, 'editetudesPart'])
        ->name('translator.etudesPart.edit');
    Route::post('/translator/updateetudesPart/{id}', [TranslatorController::class, 'updateetudesPart'])
        ->name('translator.etudes.updateetudesPart');

    Route::get('/translator/bookspart/view/{id}', [TranslatorController::class, 'viewbookspart'])
        ->name('translator.bookspart.view');

    Route::get('/translator/bookspart/edit/{id}', [TranslatorController::class, 'editbookspart'])
        ->name('translator.bookspart.edit');

    Route::post('/translator/bookspart/update/{id}', [TranslatorController::class, 'updatebookspart'])
        ->name('translator.bookspart.update');


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

    Route::get('/translator/updatepwd', 'updatepwd')->name('translator.updatepwd');
    Route::post('/translator/updatepwd/store', 'updatepwdStore')->name('translator.updatepwd.store');
    Route::get('/translatorByID', 'translatorByID')->name('translator.translatorByID');
    Route::post('translator/books/publish/{id}', [TranslatorController::class, 'publish'])->name('translator.books.publish');

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
    Route::get('/etude/view/{id}', [EditorController::class, 'viewEtudes'])
        ->name('editor.etude.view');
    Route::get('/books/view/{id}', [EditorController::class, 'viewBooks'])
        ->name('editor.books.view');
    Route::get('/etudesPart/{id}', 'etudesPart')->name('editor.pages.etudesPart');

    Route::get('/viewbooksPart/{id}', [EditorController::class, 'viewetudesPart'])
        ->name('editor.etudesPart.view');
    Route::get('/editor/editetudesPart/{id}', [EditorController::class, 'editetudesPart'])
        ->name('editor.etudesPart.edit');
    Route::post('/editor/updateetudesPart/{id}', [EditorController::class, 'updateetudesPart'])
        ->name('editor.etudes.updateetudesPart');

    Route::get('/booksPart/{id}', 'booksPart')->name('editor.pages.booksPart');

    Route::get('/editor/bookspart/view/{id}', [EditorController::class, 'viewbookspart'])
        ->name('editor.bookspart.view');

    Route::get('/editor/bookspart/edit/{id}', [EditorController::class, 'editbookspart'])
        ->name('editor.bookspart.edit');

    Route::post('/editor/bookspart/update/{id}', [EditorController::class, 'updatebookspart'])
        ->name('editor.bookspart.update');
    Route::post('editor/books/publish/{id}', [EditorController::class, 'publish'])->name('editor.books.publish');


});

Route::prefix('admin')->controller(AdminController::class)->group(function () {

    Route::get('/', 'index')->name('superAdmin.pages.index');
    Route::get('/books', 'books')->name('superAdmin.pages.books');
    Route::get('/books/delete/{id}', [AdminController::class, 'deletebooks'])
        ->name('books.delete');
    Route::post('/books/publish/{id}', [AdminController::class, 'publish'])->name('books.publish');
    Route::get('/banner', 'banner')->name('superAdmin.pages.banner');
    Route::get('/banner/addbanner', 'addbanner')->name('superAdmin.pages.addbanner');
    Route::get('/banner/delete/{id}', [AdminController::class, 'deletebannerByCategory'])
        ->name('banner.delete');
    Route::post('/banner/store', 'storebanner')->name('superAdmin.banner.store');
    Route::get('/category', 'category')->name('superAdmin.pages.category');
    Route::get('/bannercategory/{id}', 'bannerByCategory')->name('superAdmin.pages.bannerByCategory');
    Route::get('/bannercategory/add/{id}', 'addbannerByCategory')->name('superAdmin.pages.addbannerByCategory');
    Route::post('/bannercategory/store', 'storebannerByCategory')->name('superAdmin.bannerByCategory.store');

    Route::get('/bannerByCategory/delete/{id}', [AdminController::class, 'deletebannerByCategory'])
        ->name('bannerByCategory.delete');


    Route::get('/category/addcategory', 'addcategory')->name('superAdmin.pages.addcategory');
    Route::post('/category/store', 'storecategory')->name('superAdmin.category.store');
    Route::get('/category/delete/{id}', [AdminController::class, 'deletecategory'])
        ->name('category.delete');
    Route::get('/books/add', 'addbooks')->name('superAdmin.pages.addbooks');
    Route::post('/books/store', 'storeBooks')->name('superAdmin.books.store');
    Route::get('/translatorList', 'translatorList')->name('superAdmin.pages.translatorList');
    Route::get('/translatorList/delete/{id}', [AdminController::class, 'deletetranslatorList'])->name('translatorList.delete');
    Route::get('/translatorList/accepted/{id}', [AdminController::class, 'updatetranslatorList'])->name('translatorList.accepted');

    Route::get('/addtranslatorList', 'addtranslatorList')->name('superAdmin.pages.addtranslatorList');
    Route::post('/addtranslatorList/store', 'storetranslatorList')->name('superAdmin.addtranslatorList.store');
    Route::get('/translator/delete/{id}', [AdminController::class, 'deletetranslatorList'])
        ->name('translator.delete');
    Route::get('/etudes', 'etudes')->name('superAdmin.pages.etudes');
    Route::get('/superAdminetudesPart/{id}', 'etudesPart')->name('superAdmin.pages.etudesPart');
    Route::get('/superAdminetudesPart/add/{id}', 'addetudesPart')->name('superAdmin.pages.addetudesPart');
    Route::post('/superAdminetudesPart/store', 'storeetudesPart')->name('superAdmin.etudesPart.store');
    Route::get('/superAdmin/etudesPart/delete/{id}', [AdminController::class, 'deleteEtudesPart'])->name('superAdmin.etudesPart.delete');


    Route::get('/viewbooksPart/{id}', [AdminController::class, 'viewetudesPart'])
        ->name('superAdmin.etudesPart.view');
    Route::get('/superAdmin/editetudesPart/{id}', [AdminController::class, 'editetudesPart'])
        ->name('superAdmin.etudesPart.edit');
    Route::post('/superAdmin/updateetudesPart/{id}', [AdminController::class, 'updateetudesPart'])
        ->name('superAdmin.etudes.updateetudesPart');



    Route::get('/article', 'article')->name('superAdmin.pages.article');
    Route::get('/article/add', 'addArticle')->name('superAdmin.pages.addArticle');
    Route::post('/article/store', 'storeArticle')->name('superAdmin.article.store');
    Route::get('/article/edit/{id}', [AdminController::class, 'editArticle'])
        ->name('superAdmin.article.edit');
    Route::post('/books/updateArticle/{id}', [AdminController::class, 'updateArticle'])
        ->name('superAdmin.books.updateArticle');


    Route::get('/etudes/add', 'addEtudes')->name('superAdmin.pages.addEtudes');
    Route::post('/etudes/store', 'storeEtudes')->name('superAdmin.etudes.store');
    Route::get('/etudes/edit/{id}', [AdminController::class, 'editEtudes'])
        ->name('superAdmin.etudes.edit');

    Route::post('/books/updateEtudes/{id}', [AdminController::class, 'updateEtudes'])
        ->name('superAdmin.books.updateEtudes');
    //lors de partage update et la suppression des posts deja partagé
    Route::get('/listePublier', 'listePublier')->name('superAdmin.pages.listePublier');

    Route::get('/books', 'allBooks')->name('superAdmin.pages.allBooks');
    Route::get('/books/deleteall/{id}', [AdminController::class, 'deleteallbooks'])
        ->name('books.deleteall');

    Route::get('/booksPart/{id}', 'booksPart')->name('superAdmin.pages.booksPart');
    Route::get('/bookspart/add/{id}', 'addbookspart')->name('superAdmin.pages.addbookspart');
    Route::post('/bookspart/store', 'storebookspart')->name('superAdmin.bookspart.store');

    Route::get('/etudesadmin/view/{id}', [AdminController::class, 'viewEtudes'])
        ->name('admin.etudes.view');
    Route::get('/articleadmin/view/{id}', [AdminController::class, 'viewArticle'])
        ->name('admin.article.view');
    Route::get('/booksadmin/view/{id}', [AdminController::class, 'viewBooks'])
        ->name('admin.books.view');

    Route::get('/superAdmin/bookspart/view/{id}', [AdminController::class, 'viewbookspart'])
        ->name('superAdmin.bookspart.view');

    Route::get('/superAdmin/bookspart/edit/{id}', [AdminController::class, 'editbookspart'])
        ->name('superAdmin.bookspart.edit');

    Route::post('/superAdmin/bookspart/update/{id}', [AdminController::class, 'updatebookspart'])
        ->name('superAdmin.bookspart.update');
    Route::get('/books-part/delete/{id}', [AdminController::class, 'destroy'])
        ->name('booksPart.delete');

    Route::get('/superAdmin/edit/{id}', [AdminController::class, 'editBooks'])
        ->name('superAdmin.books.edit');
    Route::post('/superAdmin/update/{id}', [AdminController::class, 'updateBooks'])
        ->name('superAdmin.books.update');
    Route::get('/contactList', 'contactList')->name('superAdmin.contactList');
    Route::get('/admin/contact/delete/{id}', [AdminController::class, 'deleteContact'])
        ->name('contact.delete');
    Route::get('/emailList', 'emailList')->name('superAdmin.emailList');
    Route::get('/admin/email/delete/{id}', [AdminController::class, 'deleteEmail'])
        ->name('email.delete');
    Route::get('/partnersList', 'partnersList')->name('superAdmin.partnersList');
    Route::get('/admin/partners/delete/{id}', [AdminController::class, 'deletePartners'])
        ->name('partnersList.delete');

    Route::get('/addpartnersList', 'addpartnersList')->name('superAdmin.addpartnersList');
    Route::post('/addpartnersList/store', 'storepartnersList')->name('superAdmin.addpartnersList.store');
    Route::post('/superAdmin/books/toggle-banner', [AdminController::class, 'toggleBanner'])
        ->name('superAdmin.books.toggleBanner');
});

Route::get('/', [MiliarController::class, 'index'])->name('miliar.index');
Route::get('/indexProp2', [MiliarController::class, 'indexProp2'])->name('miliar.indexProp2');
Route::get('/translatorweb', [MiliarController::class, 'translatorweb'])->name('miliar.translatorweb');
Route::get('/translatorDetails/{id}', [MiliarController::class, 'translatorDetails'])->name('miliar.translatorDetails');
Route::get('/books', [MiliarController::class, 'books'])->name('miliar.books');
Route::get('/wordpedia', [MiliarController::class, 'books'])->name('miliar.books');
Route::get('/books1', [MiliarController::class, 'books1'])->name('miliar.books1');

Route::get('/about', [MiliarController::class, 'about'])->name('miliar.about');
Route::get('/contact', [MiliarController::class, 'contact'])->name('miliar.contact');
Route::post('/contactStore', [MiliarController::class, 'contactStore'])->name('contact.store');
Route::post('/emailStore', [MiliarController::class, 'emailStore'])->name('email.store');

Route::get('/elementor', [MiliarController::class, 'elementor'])->name('miliar.elementor');
// Route AJAX pour le select
Route::get('/search-translators', [MiliarController::class, 'searchTranslators'])->name('search.translators');
// Route avec paramètre {id}
Route::get('/booksDetails/{id}', [MiliarController::class, 'booksDetails'])->name('miliar.booksDetails');
Route::get('/wordpedia/{id}', [MiliarController::class, 'booksDetails'])->name('miliar.booksDetails');
Route::get('/booksDetails1/{id}', [MiliarController::class, 'booksDetails1'])->name('miliar.booksDetails1');
Route::get('/booksPartDetails/{id}', [MiliarController::class, 'booksPartDetails'])->name('miliar.booksPartDetails');
Route::get('/etudesPartDetails/{id}', [MiliarController::class, 'etudesPartDetails'])->name('miliar.etudesPartDetails');

Route::get('/inscription', [MiliarController::class, 'inscription'])->name('miliar.inscription');
Route::get('/register', [MiliarController::class, 'register'])->name('miliar.register');
Route::get('/demande', [MiliarController::class, 'demande'])->name('miliar.demande');
Route::post('/demande/store', [MiliarController::class, 'storedemandetranslator'])
    ->name('storedemande');
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





Route::post('/translator/forgot-password', [ForgotPasswordController::class, 'sendLink'])
    ->name('translator.forgot.password');

Route::get('/translator/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('translator.reset.password');

Route::post('/translator/reset-password', [ForgotPasswordController::class, 'updatePassword'])
    ->name('translator.update.password');