 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'addBook']);
 
Route::post('/create-book', [BookController::class, 'createBook'])->name('book.create');
Route::post('/ajax-delete-book', [BookController::class, 'deleteBook'])->name('ajax.book.delete');
