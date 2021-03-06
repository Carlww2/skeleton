<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = [
		"name", "description", "philosophy", "privacy", "terms_conditions", "logo",
	];

	protected $hidden = [
		'created_at', 'updated_at'
	];

	protected static function boot()
	{
		parent::boot();

		self::saving(function ($model) {
			$model->logo = "/img/company/".$model->logo;
		});
	}
}
