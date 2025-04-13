@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
	<div class="col">
		<h1>VENTAS</h1>
	</div>
	<div class="col-auto titlebar-commands">
		<a class="btn btn-primary" href="{{ url('/ventas/agregar') }}">Agregar</a>
	</div>
</div>

<table class="table" id="maintable">
<thead>
	<tr>
		<th scope="col">ID</th>
		<th scope="col">FECHA</th>
		<th scope="col">ESTADO</th>
	</tr>
</thead>
<tbody>
@foreach($ventas as $venta)
	<tr>
		<td class="text-center">{{$venta->id_venta}}</td>
		<td class="text-center">{{$venta->fecha}}</td>
		<td class="text-center">{{$venta->estado}}</td>
	</tr>
@endforeach
</tbody></table>
<script>
/**
Se crea la instancia de datatable con esos usos paginación y buscador
let table=new DataTable("#maintable",{paging:true,searching:true})
*/
</script>
@endsection