<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
	public function detalles()
	{
		return $this->hasMany('App\Detallesrecepcion');
	}

	public function sucursal()
	{
		return $this->belongsTo('\App\Sucursal');
	}

	public function user()
	{
		return $this->belongsTo('\App\User');
	}

	public function proveedor()
	{
		return $this->belongsTo('\App\Proveedor');
	}

}
