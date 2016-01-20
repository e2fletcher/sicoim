@extends('layouts.master')
@section('content')
@parent
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
	    <div class="panel-heading">
		<span class="label label-default">Reporte de ventas</span> 
	    </div>
            <div class="panel-body">
                <table class="table table-over">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Usuario del Sistema</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ventas as $v)
                        <tr>
                            <td><span class="label label-default">{{ $v->id }}</span></td>
                            <td>{{ Str::upper($v->cliente->nombre) }}</td>
                            <td>{{ Str::upper($v->user->name) }} ({{ Str::lower($v->user->email) }})</td>
                            <td>{{ $v->created_at }}</td>
                            <td>
                                <a class="btn btn-sx btn-default" href="{{ action('VentasController@printer') . '?id=' . $v->id  }}" role="button">Imprimir</a>
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <div>
</div>
@endsection
