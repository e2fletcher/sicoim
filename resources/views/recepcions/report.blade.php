@extends('layouts.master')
@section('content')
@parent
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
	    <div class="panel-heading">
		<span class="label label-default">Reporte de recepciones</span> 
	    </div>
            <div class="panel-body">
                <table class="table table-over">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Proveedor</th>
                            <th>Usuario del Sistema</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recepcions as $r)
                        <tr>
                            <td><span class="label label-default">{{ $r->id }}</span></td>
                            <td>{{ Str::upper($r->proveedor->nombre) }}</td>
                            <td>{{ Str::upper($r->user->name) }} ({{ Str::lower($r->user->email) }})</td>
                            <td>{{ $r->created_at }}</td>
                            <td>
                                <a class="btn btn-sx btn-default" href="{{ action('RecepcionsController@printer') . '?id=' . $r->id  }}" role="button">Imprimir</a>
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
