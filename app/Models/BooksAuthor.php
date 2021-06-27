<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BooksAuthor
 * 
 * @property string $book_title
 * @property string $author_name
 * 
 * @property Book $book
 * @property Author $author
 *
 * @package App\Models
 */
class BooksAuthor extends Model
{
	protected $table = 'books_authors';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'book_title',
		'author_name'
	];

	public function book()
	{
		return $this->belongsTo(Book::class, 'book_title');
	}

	public function author()
	{
		return $this->belongsTo(Author::class, 'author_name');
	}
}
