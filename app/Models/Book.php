<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * 
 * @property int $book_id
 * @property string $book_title
 * @property int $book_pages
 * @property int $book_year_published
 * 
 * @property Collection|Author[] $authors
 *
 * @package App\Models
 */
class Book extends Model
{
	protected $table = 'books';
	protected $primaryKey = 'book_id';
	public $timestamps = false;

	protected $casts = [
		'book_pages' => 'int',
		'book_year_published' => 'int'
	];

	protected $fillable = [
		'book_title',
		'book_pages',
		'book_year_published'
	];

	public function authors()
	{
		return $this->belongsToMany(Author::class, 'books_authors');
	}
}
