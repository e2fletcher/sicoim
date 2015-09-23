<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recepcion extends Model
{
	public function detallesRecepcion()
	{
		return $this->hasMany('App\Detallesrecepcion');
	}
}
