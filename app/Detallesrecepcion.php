<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallesrecepcion extends Model
{
	public function recepcion()
	{
		return $this->belongsTo('\App\Recepcion');
	}

	public $timestamps = false;
}
