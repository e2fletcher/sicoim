<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallesventa extends Model
{
	public function venta ()
	{
		return $this->belongsTo('\App\Venta');
	}

	public function producto()
	{
		return $this->belongsTo('\App\Producto');
	}

	public $timestamps = false;
}
