 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'addBook']);
 
Route::post('/create-book', [BookController::class, 'createBook'])->name('post.create');
