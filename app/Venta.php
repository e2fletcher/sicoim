<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	public function detalles()
	{
		return $this->hasMany('\App\Detallesventa');
	}

	public function cliente()
	{
		return $this->belongsTo('\App\Cliente');
	}
	
	public function user()
	{
		return $this->belongsTo('\App\User');
	}
	
	public function sucursal()
	{
		return $this->belongsTo('\App\Sucursal');
	}
}
