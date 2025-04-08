<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;  //外部にあるPostControllerクラスを使えるようにします。
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//以下本来の設定を書き換えてトップページの作成にとりかかる
// Route::get('/', function () {
//     return view('welcome');
// });


/*testで消した
Route::get('/', function () {
    return view('posts.toppage');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

// 投稿関連のルート
Route::get('/', [PostController::class, 'index']);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // ← 追加

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/toggle-like', [LikeController::class, 'toggle'])->name('posts.toggle_like');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    // Route::post('/posts/{post}/like', [LikeController::class, 'store'])->middleware('auth')->name('posts.like');
    // Route::delete('/posts/{post}/unlike', [LikeController::class, 'destroy'])->middleware('auth')->name('posts.unlike');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'delete']);
    Route::get('/notifications', function () {
        return view('notifications.index', [
            'notifications' => auth()->user()->notifications
        ]);
    })->middleware('auth');
});

// 投稿詳細ページ（未ログインでも見られる）
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

//Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する
//

// カテゴリー関連のルート
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// キュレーション関連のルート
Route::get('/curations', [CurationController::class, 'index'])->name('curations.index');
Route::get('/curations/{id}', [CurationController::class, 'show'])->name('curations.show');

// ランキングページ
//Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

// その他のページ
//Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/guides', [PageController::class, 'guides'])->name('guides');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// ダッシュボード
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 認証が必要なルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
//testでやってる
//Route::get('/', [PostController::class, 'index']);
Route::get('/top', [PostController::class, 'toppage']);
// Route::get('/', function () {
//     return view('posts.index');
// });
