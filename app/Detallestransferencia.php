<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detallestransferencia extends Model
{
	public function transferencia()
	{
		return $this->belongsTo('\App\Transferencia');
	}

	public function producto()
	{
		return $this->belongsTo('\App\Producto');
	}

	public $timestamps = false;
}
