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
 * @property int $author_id
 * @property string $author_first_name
 * @property string $author_last_name
 * 
 * @property Collection|Book[] $books
 *
 * @package App\Models
 */
class Author extends Model
{
	protected $table = 'authors';
	protected $primaryKey = 'author_id';
	public $timestamps = false;

	protected $fillable = [
		'author_first_name',
		'author_last_name'
	];

	public function books()
	{
		return $this->belongsToMany(Book::class, 'books_authors');
	}
}
