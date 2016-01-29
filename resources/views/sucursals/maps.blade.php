@extends('layouts.master')

@section('head')
@parent
  <script src="{{ asset("vendor/webcomponentsjs/webcomponents-lite.min.js") }}"></script>
  <link rel="import" href="{{ asset('vendor/google-map/google-map.html') }}">
  <link rel="import" href="{{ asset('vendor/google-map/google-map-marker.html') }}">
@endsection

@section('content')
@parent
<style>
  .row {
    margin-top: 30px;
  }
  google-map {
    height: 600px;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><span class="glyphicon glyphicon-home" aria-hidden="true"></span><i class="fa fa-maps"></i> Mapa de sucursales</div>
      <div class="panel-body">
          <google-map latitude="{{ $center['latitud'] }}" longitude="{{ $center['longitud'] }}" fit-to-markers>
          @foreach($points as $point)
            <google-map-marker icon="{{ asset('img/pushping.png') }}" latitude="{{ $point['latitud'] }}" longitude="{{ $point['longitud'] }}" title="{{ $point['nombre'] }}">
              <div class="row">
                <div class="col-md-6"> 
                 <img class="img-responsive" src="{{ asset('storage/sucursals/' . $point['photo'])  }}" alt="{{ $point['nombre'] }}" style="width:300px;height:200px">
                </div>
                <div class="col-md-6"> 
                  <div class="row">              
                    <div class="col-md-12"> 
                      <small><i class="fa fa-home"></i> {{ $point['nombre']  }}</small>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12"> 
                      <small><i class="fa fa-home"></i> {{ $point['direccion']  }}</small>
                    </div>
                  </div>
                </div>
              </div>

            </google-map-marker>
          @endforeach
					</google-map>              
        </div>
      </div>
    </div>
  </div>
@endsection


