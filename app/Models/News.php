<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $fillable = [
		"title", "content", "photo"
	];

	protected static function boot()
	{
		parent::boot();
		self::saving(function ($model) {
			$model->photo = "/img/news/".$model->photo;
		});
	}
}
