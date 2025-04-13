@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
	<div class="col">
		<h1>GOLOSINAS</h1>
	</div>
</div>

<table class="table" id="maintable">
<thead>
	<tr>
		<th scope="col">ID</th>
		<th scope="col">NOMBRE</th>
		<th scope="col">PRECIO</th>
		<th scope="col">EXISTENCIA</th>
		<th scope="col">ESTADO</th>
	</tr>
</thead>
<tbody>
@foreach($golosinas as $golosina)
	<tr>
		<td class="text-center">{{$golosina->id_golosina}}</td>
		<td class="text-center">{{$golosina->nombre}}</td>
		<td class="text-center">{{$golosina->precioVenta}}</td>
		<td class="text-center">{{$golosina->cantExistencia}}</td>
		<td class="text-center">{{$golosina->estado}}</td>
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