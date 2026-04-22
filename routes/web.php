<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Pages login
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

// Admin routes
Route::get('/admin/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');

Route::middleware('auth')->prefix('/admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    

    // Gestion des menus
    Route::resource('/menus', App\Http\Controllers\Admin\MenuController::class);
    Route::post('/menus/{id}/update-position', [App\Http\Controllers\Admin\MenuController::class, 'updatePosition'])->name('menus.updatePosition');
    Route::resource('/espacement-menus', App\Http\Controllers\Admin\EspacementMenuController::class);
    Route::resource('/sidebar-menus', App\Http\Controllers\Admin\SidebarMenuController::class);

    // Gestion des paramètres du site
    Route::resource('/general-settings', App\Http\Controllers\Admin\GeneralSettingController::class);
    Route::get('config/accueil', [App\Http\Controllers\Admin\AccueilController::class, 'index'])->name('admin.accueil');
    Route::post('config/accueil', [App\Http\Controllers\Admin\AccueilController::class, 'save'])->name('admin.accueil.save');

    Route::get('config/qui-sommes-nous/decouvrir-sonec-africa', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'index'])->name('admin.decouvrir-sonec-africa');
    Route::post('config/qui-sommes-nous/decouvrir-sonec-africa', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'save'])->name('admin.decouvrir-sonec-africa.save');
    Route::get('config/qui-sommes-nous/notre-histoire', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'histoire'])->name('admin.histoire');
    Route::post('config/qui-sommes-nous/notre-histoire', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'saveHistoire'])->name('admin.histoire.save');
    Route::get('config/qui-sommes-nous/notre-equipe', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'equipe'])->name('admin.notre-equipe');
    Route::post('config/qui-sommes-nous/notre-equipe', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'saveEquipeContent'])->name('admin.notre-equipe.save');
    Route::get('config/qui-sommes-nous/implantation', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'implantation'])->name('admin.implantation');
    Route::post('config/qui-sommes-nous/implantation', [App\Http\Controllers\Admin\QuiSommesNousController::class, 'saveImplantationContent'])->name('admin.implantation.save');

    Route::get('actualites', [App\Http\Controllers\Admin\ActualiteController::class, 'index'])->name('admin.actualites');
    Route::resource('/categorie-articles', App\Http\Controllers\Admin\CategorieArticleController::class);
    Route::resource('/tags', App\Http\Controllers\Admin\TagController::class);
    Route::resource('/articles', App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('/solutions', App\Http\Controllers\Admin\SolutionController::class);
    Route::resource('/secteur-expertise', App\Http\Controllers\Admin\SecteurExpertiseController::class);
    // Route vers page configuration solution
    Route::get('config/solution', [App\Http\Controllers\Admin\SolutionController::class, 'configuration'])->name('admin.solution-page.config');
    Route::post('config/solution', [App\Http\Controllers\Admin\SolutionController::class, 'saveConfiguration'])->name('admin.solution-page.config.save');

    Route::resource('/offres-emploi', App\Http\Controllers\Admin\OffreEmploiController::class);
    

    // Deconnexion
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
});


// Accueil
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.home');

// Accueil
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.home');

// Actualités
Route::get('/actualites', [App\Http\Controllers\Web\ActualiteController::class, 'index'])->name('web.actualites');
Route::get('/actualites/{slug}', [App\Http\Controllers\Web\ActualiteController::class, 'show'])->name('web.actualites.show');

// Carrières
Route::get('/carrieres', [App\Http\Controllers\Web\CarriereController::class, 'index'])->name('web.carrieres');
Route::get('/carrieres/{slug}', [App\Http\Controllers\Web\CarriereController::class, 'show'])->name('web.carrieres.show');

// Solutions — /{slug} directement (slugs: ecoleweb, gdec, sonecpay)
Route::get('/solutions', [App\Http\Controllers\Web\SolutionController::class, 'index'])->name('web.solutions.index');
Route::get('/solutions/{slug}', [App\Http\Controllers\Web\SolutionController::class, 'show'])->name('web.solutions.show');

// Industries — /{slug} directement (slugs: banques-et-assurances, telecoms...)
Route::get('/industries', [App\Http\Controllers\Web\SecteurExpertiseController::class, 'index'])->name('web.secteurs.index');
Route::get('/industries/{slug}', [App\Http\Controllers\Web\SecteurExpertiseController::class, 'show'])->name('web.secteurs.show');

// Qui sommes-nous
Route::get('/qui-sommes-nous', [App\Http\Controllers\Web\PagesController::class, 'quiSommesNous'])->name('web.qui-sommes-nous');
Route::get('/decouvrir-sonec-africa', [App\Http\Controllers\Web\PagesController::class, 'decouvrir'])->name('web.decouvrir-sonec-africa');
Route::get('/notre-histoire', [App\Http\Controllers\Web\PagesController::class, 'histoire'])->name('web.notre-histoire');
Route::get('/equipe-de-direction', [App\Http\Controllers\Web\PagesController::class, 'equipe'])->name('web.equipe-de-direction');

// Contact
Route::get('/contact', [App\Http\Controllers\Web\ContactController::class, 'index'])->name('web.contact');
Route::post('/contact', [App\Http\Controllers\Web\ContactController::class, 'send'])->name('web.contact.send');

// Route générique — EN DERNIER
Route::get('/{slug}', [App\Http\Controllers\Web\PagesController::class, 'index'])->name('web.pages');



// Route::get('/{slug}', [App\Http\Controllers\Web\PagesController::class, 'index'])->name('web.pages');