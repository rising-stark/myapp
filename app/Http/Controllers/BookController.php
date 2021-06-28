<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Author;
use App\Models\BooksAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
	public function index(){
		$books = DB::table('books_authors')
					->join('books', 'books_authors.book_title', '=', 'books.book_title')
					->join('authors', 'books_authors.author_name', '=', 'authors.author_name')
					->get();
		return view('index', compact('books'));
	}

	public function createBook(Request $request){
		$bookexists = false;
		$authorexists = false;
		$exists = false;

		try{
			$book = new Book();
			$book->book_title = $request->book_title;
			$book->book_pages = $request->book_pages;
			$book->book_year_published = $request->book_year_published;
			$book->save();
		}catch(Exception $e){
			//Book already exists
			$bookexists = true;
		}

		try{
			$author = new Author();
			$author->author_name = $request->author_name;
			$author->save();
		}catch(Exception $e){
			//Author already exists
			$authorexists = true;
		}

		if($bookexists == true and $authorexists == true){
			$exists = DB::table('books_authors')->where(['book_title' => $request->book_title, 'author_name' => $request->author_name])->exists();
		}

		if($exists == true){
			return back()->with('book-exists', 'Book And Author Pair Already Exists');
		}else{
			$booksauthor = new BooksAuthor();
			$booksauthor->book_title = $request->book_title;
			$booksauthor->author_name = $request->author_name;
			$booksauthor->save();
			
			return back()->with('book-added', 'Book has been added successfully');
		}
	}

	public function deleteBook(Request $request){
		try{
			DB::table('books_authors')->where(['book_title' => $request->book_title, 'author_name' => $request->author_name])->delete();
			return 1;
		}catch(Exception $e){
			error_log($e);
			return 0;
		}
	}
}