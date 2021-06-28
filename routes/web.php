 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index']);

Route::post('/create-book', [BookController::class, 'createBook'])->name('book.create');
Route::post('/ajax-delete-book', [BookController::class, 'deleteBook'])->name('ajax.book.delete');
Route::post('/ajax-update-author', [BookController::class, 'updateAuthor'])->name('ajax.author.update');

Route::post('/ajax-export-table-csv', [BookController::class, 'exportTableCSV'])->name('ajax.table.export.csv');
Route::post('/ajax-export-table-xml', [BookController::class, 'exportTableXML'])->name('ajax.table.export.xml');
Route::post('/ajax-export-table-cur', [BookController::class, 'exportTableCUR'])->name('ajax.table.export.cur');
