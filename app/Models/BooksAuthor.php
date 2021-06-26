<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BooksAuthor
 * 
 * @property int $book_id
 * @property int $author_id
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

	protected $casts = [
		'book_id' => 'int',
		'author_id' => 'int'
	];

	protected $fillable = [
		'book_id',
		'author_id'
	];

	public function book()
	{
		return $this->belongsTo(Book::class);
	}

	public function author()
	{
		return $this->belongsTo(Author::class);
	}
}
