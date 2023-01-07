<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// AUTH
Auth::routes();

// COMMON PAGES
Route::get('/', 'MainController@getHome')->name('home');

Route::get('/actualite', 'NewsController@getNews')->name('news');
Route::get('/actualite/{slug}', 'NewsController@getNewsDetails')->name('newsdetails');
Route::post('/actualite/{id}/commentaire', 'NewsController@addComments')->name('newscomments');
Route::get('/actualite/commentaire/delete', 'NewsController@deleteComments')->name('delete_comments');

Route::get('/jeux', 'GamesController@getGames')->name('games');
Route::get('/jeux/{slug}', 'GamesController@getGamesDetails')->name('gamesdetails');
Route::post('/jeux/pagination', 'GamesController@pagination');
Route::post('/jeux/recherche', 'GamesController@search');
Route::post('/jeux/favoris', 'GamesController@addFavoriteGame')->name('add_favorite_game');

Route::get('/jeux/categorie/{slug}', 'CategoriesController@getGamesCategories')->name('gamescategories');
Route::get('/jeux/plateforme/{slug}', 'PlatformsController@getGamesPlatforms')->name('gamesplatforms');

// USER PROFILE PAGE
Route::get('/profil', 'User\UserController@getProfile')->name('profile');
Route::post('/profil/avatar', 'User\UserController@updateAvatar');
Route::post('/profil/nom', 'User\UserController@updateName');
Route::post('/profil/email', 'User\UserController@updateEmail');
Route::post('/profil/bio', 'User\UserController@updateBio');
Route::get('/profil/favoris/supprimer', 'User\UserController@deleteFavoriteGame')->name('delete_favorite_game');

// ADMIN PAGES
Route::prefix('admin')->group(function() {
    Route::get('/', 'Admin\AdminController@index')->name('admin_dashboard');
    Route::get('/login','Admin\AdminLoginController@showLoginForm')->name('admin_login');
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin_login_submit');
    Route::get('logout/', 'Admin\AdminLoginController@logout')->name('admin_logout');

    Route::get('/jeux', 'Admin\AdminGamesController@getGames')->name('admin_games');
    Route::post('/jeux/add', 'Admin\AdminGamesController@addGame')->name('add_game');
    Route::post('/jeux/update', 'Admin\AdminGamesController@updateGame')->name('update_game');
    Route::get('/jeux/delete', 'Admin\AdminGamesController@deleteGame')->name('delete_game');
    
    Route::get('/plateformes', 'Admin\AdminPlatformsController@getPlatforms')->name('admin_platforms');
    Route::post('/plateformes/add', 'Admin\AdminPlatformsController@addPlatform')->name('add_platform');
    Route::post('/plateformes/update', 'Admin\AdminPlatformsController@updatePlatform')->name('update_platform');
    Route::get('/plateformes/delete', 'Admin\AdminPlatformsController@deletePlatform')->name('delete_platform');    
    
    Route::get('/categories', 'Admin\AdminCategoriesController@getCategories')->name('admin_categories');
    Route::post('/categories/add', 'Admin\AdminCategoriesController@addCategory')->name('add_category');
    Route::post('/categories/update', 'Admin\AdminCategoriesController@updateCategory')->name('update_category');
    Route::get('/categories/delete', 'Admin\AdminCategoriesController@deleteCategory')->name('delete_category');
    
    Route::get('/actualite', 'Admin\AdminNewsController@getNews')->name('admin_news');
    Route::post('/actualite/add', 'Admin\AdminNewsController@addNews')->name('add_news');
    Route::post('/actualite/update', 'Admin\AdminNewsController@updateNews')->name('update_news');
    Route::get('/actualite/delete', 'Admin\AdminNewsController@deleteNews')->name('delete_news');
    
    Route::get('/highlight', 'Admin\AdminNewsHighlightsController@getNews')->name('admin_news_highlights');
    Route::post('/highlight/add', 'Admin\AdminNewsHighlightsController@addNewsHighlights')->name('add_news_highlights');

    Route::get('/utilisateurs', 'Admin\AdminUsersController@getUsers')->name('admin_users');
    Route::post('/utilisateurs/add', 'Admin\AdminUsersController@addUser')->name('add_user');
    Route::post('/utilisateurs/update', 'Admin\AdminUsersController@updateUser')->name('update_user');
    Route::post('/utilisateurs/update/password', 'Admin\AdminUsersController@updatePasswordUser')->name('update_password_user');
    Route::get('/utilisateurs/delete', 'Admin\AdminUsersController@deleteUser')->name('delete_user');
}) ;