<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Sucursales</title>
	<style>
	* { -moz-box-sizing:border-box; -webkit-box-sizing:border-box; box-sizing:border-box; }
	body { margin:0; font:10pt Arial; color:#242424; }
	#mapArea { position:absolute; width:100%; height:100%; }
	</style>
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.min.js"></script>
	<script src="http://openlayers.org/api/2.13.1/OpenLayers.js"></script>
	<script>
	function PlotData(divId, data) {

		function Geo(map, lat, lon) {
			return new OpenLayers.LonLat(lon, lat)
				.transform(new OpenLayers.Projection('EPSG:4326'), map.getProjectionObject());
		}

		function PlotMarker(map, lat, lon, bottomOffset, onDone) {
			var imgObj = new Image();
			img = '{!! asset('img/pushping.png') !!}';
			imgObj.src = img;
			imgObj.onload = function() {
				var sz = new OpenLayers.Size(imgObj.width, imgObj.height);
				var off = new OpenLayers.Pixel(-(sz.w / 2),
				bottomOffset ? -sz.h : -(sz.w / 2));
				var ico = new OpenLayers.Icon(img, sz, off);
				if(onDone !== undefined && onDone !== null)
					onDone(new OpenLayers.Marker(Geo(map, lat, lon), ico));
			};
		}

		var map = new OpenLayers.Map(divId);
		map.addLayer(new OpenLayers.Layer.OSM());
		map.setCenter(Geo(map, data.center[0], data.center[1]), data.zoom);

		var markers = new OpenLayers.Layer.Markers('Markers');
		map.addLayer(markers);

		var $map = $('#'+divId),
		$det = $('<div></div>').css({
			'position':'absolute',
			'padding':'0 4px',
			'display':'none',
			'box-shadow':'2px 2px 3px #999',
			'background-color':'rgba(255,255,255,.85)',
			'border':'1px solid #AAA'
		}).appendTo('body');
		$.each(data.points, function(i, pt) {
			PlotMarker(map, pt.coor[0], pt.coor[1], true, function(mk) {
				markers.addMarker(mk);
				mk.events.on({
					mouseover: function(ev) {
						$det.html(pt.text).css({
							left: (ev.pageX < $(document).width() / 2) ?
								ev.pageX+'px' : (ev.pageX - $det.outerWidth())+'px',
							top: (ev.pageY < $(document).height() / 2) ?
								ev.pageY+'px' : (ev.pageY - $det.outerHeight())+'px',
								display: 'block'
							});
							$map.css('cursor', 'pointer');
						},
					mouseout: function(ev) {
						$det.empty().css('display', 'none');
						$map.css('cursor', 'auto');
					}
				});
			});
		});
	}

	$(document).ready(function() {
		$.getJSON('{!! action('SucursalsController@maps') !!}', function(data) {
			PlotData('mapArea', data);
		});
	});

	</script>
</head>
<body>
	<div id="mapArea"></div>
</body>
</html>

