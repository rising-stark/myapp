<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * 
 * @property string $author_name
 * 
 * @property Collection|Book[] $books
 *
 * @package App\Models
 */
class Author extends Model
{
	protected $table = 'authors';
	protected $primaryKey = 'author_name';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = false;

	protected $fillable = [
		'author_name'
	];

	public function books()
	{
		return $this->belongsToMany(Book::class, 'books_authors', 'author_name', 'book_title');
	}
}
