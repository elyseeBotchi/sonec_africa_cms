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


    Route::get('actualites', [App\Http\Controllers\Admin\ActualiteController::class, 'index'])->name('admin.actualites');
    Route::resource('/categorie-articles', App\Http\Controllers\Admin\CategorieArticleController::class);
    Route::resource('/tags', App\Http\Controllers\Admin\TagController::class);
    



    // Deconnexion
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('admin.logout');
});


// Route pour la page d'accueil du site web
Route::get('/', [App\Http\Controllers\Web\HomeController::class, 'index'])->name('web.home');