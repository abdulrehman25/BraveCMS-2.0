<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\ArticleCategoryController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Http\Controllers\Dashboard\CommentController;


// Article routes
Route::get('/', [ArticlesController::class, 'index'])->name('homepage');
Route::get('/category/{category_id}', [ArticlesController::class, 'category'])->name('category');
Route::get('/author/{user_id}', [ArticlesController::class, 'author'])->name('author');
Route::get('/show/{slug}', [ArticlesController::class, 'show'])->name('show');

// Add comments
Route::post('/comment/submit', [ArticlesController::class, 'add_comment'])->name('comment.submit');

// Page routes
Route::get('/page/{id}', [PagesController::class, 'page'])->name('page');

// Contact page routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Newsletter subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Auth::routes();

// Dashboard routes
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function() {
  Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

	
	// Settings routes
	Route::group(['prefix' => 'settings'], function() {
		Route::get('/', [SettingsController::class, 'index'])->name('dashboard.settings');
		Route::post('/update', [SettingsController::class, 'update'])->name('dashboard.settings.update');
	}); 

	// Pages routes
	Route::group(['prefix' => 'pages'], function() {
		Route::get('/', [PageController::class, 'index'])->name('dashboard.pages');
		Route::get('/new', [PageController::class, 'create'])->name('dashboard.pages.new');
		Route::post('/add', [PageController::class, 'save'])->name('dashboard.pages.add');
		Route::get('/edit/{id}', [PageController::class, 'edit'])->name('dashboard.pages.edit');
		Route::post('/update/{id}', [PageController::class, 'update'])->name('dashboard.pages.update');
		Route::get('/delete/{id}', [PageController::class, 'delete'])->name('dashboard.pages.delete');
	});
	
	// Category routes
	Route::group(['prefix' => 'categories'], function() {
		Route::get('/', [ArticleCategoryController::class, 'index'])->name('dashboard.categories');
		Route::get('/new', [ArticleCategoryController::class, 'create'])->name('dashboard.categories.new');
		Route::post('/add', [ArticleCategoryController::class, 'save'])->name('dashboard.categories.add');
		Route::get('/edit/{id}', [ArticleCategoryController::class, 'edit'])->name('dashboard.categories.edit');
		Route::post('/update/{id}', [ArticleCategoryController::class, 'update'])->name('dashboard.categories.update');
		Route::get('/delete/{id}', [ArticleCategoryController::class, 'delete'])->name('dashboard.categories.delete');
	});

	// Article routes
	Route::group(['prefix' => 'articles'], function() {
		Route::get('/', [ArticleController::class, 'index'])->name('dashboard.articles');
		Route::get('/new', [ArticleController::class, 'create'])->name('dashboard.articles.new');
		Route::post('/add', [ArticleController::class, 'save'])->name('dashboard.articles.add');
		Route::get('/edit/{id}', [ArticleController::class, 'edit'])->name('dashboard.articles.edit');
		Route::post('/update/{id}', [ArticleController::class, 'update'])->name('dashboard.articles.update');
		Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('dashboard.articles.delete');
	}); 

	// Comments routes
	Route::group(['prefix' => 'comments'], function() {
		Route::get('/', [CommentController::class, 'index'])->name('dashboard.comments');
		Route::get('/delete/{id}', [CommentController::class, 'delete'])->name('dashboard.comments.delete');
    Route::get('/approve/{id}', [CommentController::class, 'approve'])->name('dashboard.comments.approve');
    Route::get('/unapprove/{id}', [CommentController::class, 'unapprove'])->name('dashboard.comments.unapprove');
	});

	// User routes
	Route::group(['prefix' => 'user'], function() {
		Route::get('/', [UserController::class, 'index'])->name('user');
		Route::match(['get', 'post'],'/update', [UserController::class, 'update'])->name('user.update');
		Route::post('/deleteavatar/{id}/{fileName}', [UserController::class, 'deleteavatar'])->name('user.deleteavatar');
	});

});


