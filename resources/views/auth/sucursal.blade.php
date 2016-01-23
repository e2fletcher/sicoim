<?php 
    $sucursales = \App\Sucursal::all() 
?>

@foreach($sucursales as $sucursal)
    <option value="{{ $sucursal->id }}" >{{ Str::upper($sucursal->nombre) }}</option>
@endforeach
