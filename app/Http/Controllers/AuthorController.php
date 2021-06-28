<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Author;
use App\Models\BooksAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller{
	public function updateAuthor(Request $request){
		try{
			/*
			There is ambiguity here i.e., we change all instances of the author_name in the books_authors table where author_name = old_author_name or just change for this book.
			Here I am changing in books_authors table because this would mean that there is some other guy now who wrote this book but changing in authors table would mean that name of the person changed itself so in all the books written by him, his name must be changed. The latter choice seems highly unlikely and I am implementing the former option here.
			*/
			
			$exists = DB::table('authors')->where('author_name', $request->new_author_name)->exists();
			if($exists == false){
				$author = new Author();
				$author->author_name = $request->new_author_name;
				$author->save();
			}

			DB::table('books_authors')->where(['book_title' => $request->book_title, 'author_name' => $request->old_author_name])->update(['author_name' => $request->new_author_name]);

			return 1;
		}catch(Exception $e){
			error_log($e);
			return 0;
		}
	}
}
