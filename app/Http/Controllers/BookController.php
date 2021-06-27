<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Book;
use App\Models\Author;
use App\Models\BooksAuthor;
use Illuminate\Http\Request;

class BookController extends Controller
{
	public function addBook(){
		return view('index');
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
			$exists = BooksAuthor::where(['book_title' => '$request->book_title', 'author_name' => '$request->author_name'])->exists();
		}

		if($exists == false){
			$booksauthor = new BooksAuthor();
			$booksauthor->book_title = $request->book_title;
			$booksauthor->author_name = $request->author_name;
			$booksauthor->save();
			
			return back()->with('book-added', 'Book has been added successfully');
		}else{
			return back()->with('book-exists', 'Book And Author Pair Already Exists');			
		}
	}
}