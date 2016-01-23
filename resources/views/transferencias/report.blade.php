@extends('layouts.master')
@section('content')
@parent
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
	    <div class="panel-heading">
		<span class="label label-default">Reporte de transferencias</span> 
	    </div>
            <div class="panel-body">
                <table class="table table-over">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sucursal de envio</th>
                            <th>Sucursal de destino</th>
                            <th>Usuario del Sistema</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transferencias as $r)
                        <tr>
                            <td><span class="label label-default">{{ $r->id }}</span></td>
                            <td>{{ Str::upper($r->sucursal->nombre) }}</td>
                            <td>{{ Str::upper($r->sucursal_hasta->nombre) }}</td>
                            <td>{{ Str::upper($r->user->name) }} ({{ Str::lower($r->user->email) }})</td>
                            <td>{{ $r->created_at }}</td>
                            <td>
                                <a class="btn btn-sx btn-default" href="{{ action('TransferenciasController@printer') . '?id=' . $r->id  }}" role="button">Imprimir</a>
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
