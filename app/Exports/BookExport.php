<?php

namespace App\Exports;

use App\Models\Book;
use App\Models\Author;
use App\Models\BooksAuthor;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromCollection/*, WithHeadings*/{

	protected $id;
	function __construct($id) {
		$this->id = $id;
	}

	/*public function headings(): array {
		return [
			"username", "name"
		];
	}*/

	public function collection(){

		$export_cols_arr = $this->id;

		$books = DB::table('books_authors')
					->join('books', 'books_authors.book_title', '=', 'books.book_title')
					->join('authors', 'books_authors.author_name', '=', 'authors.author_name');

		foreach($export_cols_arr as $i){
			$books = $books->addSelect('books_authors.'.$i);
		}
		return $books->get();
	}
}