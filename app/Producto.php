<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	public function tipo()
	{
		return $this->belongsTo('\App\Tipo');
	}

	public function sucursal()
	{
		return $this->belongsTo('\App\Sucursal');
	}

	public $timestamps = false;
}
