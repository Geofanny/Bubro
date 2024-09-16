<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;


class Product extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'category_id',
		'stock',
		'image'
	];

	protected $with = ['category'];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id');
	}
}
