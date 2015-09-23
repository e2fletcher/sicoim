<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	public function detallesVenta()
	{
		return $this->hasMany('\App\Detallesventa');
	}
}
