<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table = 'books';
	protected $primaryKey = 'book_title';
	public $incrementing = false;
	protected $keyType = 'string';
	public $timestamps = false;

	protected $casts = [
		'book_pages' => 'int',
		'book_year_published' => 'int'
	];

	protected $fillable = [
		'book_pages',
		'book_year_published'
	];

	public function authors()
	{
		return $this->belongsToMany(Author::class, 'books_authors', 'book_title', 'author_name');
	}
}
