 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookExportController;

Route::get('/', [BookController::class, 'index']);

Route::post('/create-book', [BookController::class, 'createBook'])->name('book.create');
Route::post('/ajax-delete-book', [BookController::class, 'deleteBook'])->name('ajax.book.delete');
Route::post('/ajax-update-author', [AuthorController::class, 'updateAuthor'])->name('ajax.author.update');

Route::post('/ajax-export-table-csv', [BookExportController::class, 'exportTableCSV'])->name('ajax.table.export.csv');
Route::post('/ajax-export-table-xml', [BookExportController::class, 'exportTableXML'])->name('ajax.table.export.xml');
