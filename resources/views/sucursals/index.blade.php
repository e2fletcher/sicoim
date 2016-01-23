@extends('layouts.master')
@section('content')
    @parent
<div class="row">
    <div class="col-md-12">
	<div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> SUCURSALES</div>
                <div class="panel-body">
                    @include('layouts.errors')
                    @if(isset($alert))
                    <div class="row">
                        <div class="col-md-12">
                        @include('layouts.alert')
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <form class="navbar-form navbar-left" role="search" action="{!! action('SucursalsController@index')  !!}">
                                <button type="button" class="btn btn-primary" id="button_add"><i class="fa fa-plus-square"></i> Agregar</button>
                                    <div class="form-group">
                                        <input type="text" name="search" class="form-control" placeholder="Sucursal">
                                    </div>
                                <button type="submit" id="button_search" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                    <table class="table table-hover">
                                            <thead>
                                                    <tr>
                                                            <th class="col-md-1">Codigo</th>
                                                            <th class="col-md-5">Sucursal</th>
                                                            <th class="col-md-4">Dirección</th>
                                                            <th class="col-md-2"></th>
                                                    </tr>
                                            <tbody>
                                                    @foreach ($sucursals as $sucursal)
                                                    <tr data-id="{{ $sucursal->id  }}" data-ident="{{ $sucursal->ident }}" data-nombre="{{ $sucursal->nombre }}" data-direccion="{{ $sucursal->direccion }}" data-tlf="{{ $sucursal->tlf }}" data-coordenadas='{{ $sucursal->coordenadas  }}'>
                                                            <td class="col-md-1"><span class="label label-default">{{ \Str::upper($sucursal->ident) }}</span></td>
                                                            <td class="col-md-5">
                                                                    <span class="label label-default">
                                                                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> 
                                                                            {{ \Str::upper($sucursal->nombre) }}
                                                                    </span>
                                                            </td>
                                                            <td class="col-md-4">{{ \Str::upper($sucursal->direccion) }}</td>
                                                            <td class="col-md-2 text-right">
                                                                <div class="btn-group" role="group" aria-label="...">
                                                                    <button class="btn btn-default" type="button" data-name="button_edit" data-toggle="modal" data-target="#modal_form"><i class="fa fa-edit"></i></button>
                                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#layouts_modal_alert"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    @endforeach
                                            </tbody>
                                    </table>
                                            </thead>
                                    </table>
                                    {!! $sucursals->render() !!}
                            </div>
                    </div>
            </div>
            </div>
	</div>
</div>
@include('layouts.modal_alert')
@include('sucursals.modal_form')
@endsection

@section('body')
@parent
<script>
	$(document).ready(function(){
		console.log('> document ready');
		/**
		 * Button Add
		 */
		$("#button_add").button().click(function(){
                    $("input#modal_form-ident").removeAttr('disabled');
                    console.log("> Clicked button_add");
			$('#modal_form').modal("show");
			$('#modal_form-title').text("Agregar");
			$('#modal_form-form').attr('action', '{!! action('SucursalsController@create') !!}');
		});

		/**
		 * Button Delete
		 */
		$('#layouts_modal_alert').on('show.bs.modal', function (e) {
			console.log("> Clicked button_delete")
			sucursal = $(e.relatedTarget).parents("tr");
			$($('#layouts_modal_alert').find('.bg-warning')).text("Desea eliminar a " + sucursal.data("nombre").toUpperCase());
		});
		$('#layouts_modal_alert_acept').button().click(function(){
			$.ajax({ url: "{!! action("SucursalsController@destroy") !!}", data: {"id" : sucursal.data("id")} })
				.done(function(){
					$('#layouts_modal_alert').modal('hide');
					$(sucursal).fadeOut();
				});
		});

		/**
		 * Button Edit
		 */
		$("#modal_form").on('show.bs.modal', function(e){
			if($(e.relatedTarget).data('name') == 'button_edit')
			{
				console.log('Clicked button_edit');
				sucursal = $(e.relatedTarget).parents("tr");

                                $("input#modal_form-ident").attr('disabled','disabled');
                                $("input#modal_form-id").val(sucursal.data("id"));
				$("input#modal_form-ident").val(sucursal.data("ident"));
				$("input#modal_form-nombre").val(sucursal.data("nombre"));
				$("input#modal_form-direccion").val(sucursal.data("direccion"));
				$("input#modal_form-coordenadas").val(sucursal.data("coordenadas"));
				$("input#modal_form-tlf").val(sucursal.data("tlf"));
				
				$('#modal_form-form').attr('action', '{!! action('SucursalsController@update') !!}');
				$('#modal_form-title').text("Modificar");
			}
		});

	});

</script>
@endsection

