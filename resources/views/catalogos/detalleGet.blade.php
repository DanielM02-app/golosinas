@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="row my-4">
	<div class="col">
		<h1>DETALLE VENTA</h1>
	</div>
</div>

<table class="table" id="maintable">
<thead>
	<tr>
        <th scope="col">ID</th>
        <th scope="col">ID GOLOSINA</th>
        <th scope="col">ID VENTA</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">PRECIO DE VENTA</th>
        <th scope="col">IMPORTE</th>
	</tr>
</thead>
<tbody>
@foreach($detalles as $detalle)
	<tr>
        <td class="text-center">{{$detalle->id_det_gol_venta}}</td>
        <td class="text-center">{{$detalle->fk_id_golosina}}</td>
        <td class="text-center">{{$detalle->fk_id_venta}}</td>
        <td class="text-center">{{$detalle->cantidad}}</td>
        <td class="text-center">{{$detalle->precioVenta}}</td>
        <td class="text-center">{{$detalle->importe}}</td>
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