<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
	public function detalles()
	{
		return $this->hasMany('\App\Detallestransferencia');
	}

	public function user()
	{
		return $this->belongsTo('\App\User');
	}

	public function sucursal()
	{
		return $this->belongsTo('\App\Sucursal');
	}

	public function sucursal_hasta()
	{
		return $this->belongsTo('\App\Sucursal', 'sucursal_hasta_id');
	}
}
