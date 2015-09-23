<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallesventa.php extends Model
{
	public function venta ()
	{
		return $this->belongsTo('\App\Venta');
	}

	public $timestamps = false;
}
