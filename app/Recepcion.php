<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
	public function productos()
	{
		return $this->belongsToMany('App\Producto', 'recepcions_productos');
	}
}
