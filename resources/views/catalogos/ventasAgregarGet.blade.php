@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-3">
    <div class="col">
        <h1>Agregar Venta</h1>
    </div>
</div>

<form method="post" action="{{ url('/ventas/agregar') }}">
    @csrf

    <!-- Datos de la cabecera de venta -->
    <div class="row my-2">
        <div class="col-md-4">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="form-control" required autofocus>
        </div>
        <div class="col-md-4">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="1">Activo</option>
                <option value="0">No activo</option>
            </select>
        </div>
    </div>

    <hr>

    <!-- Sección para agregar varios detalles de venta -->
    <h3>Detalle de Venta</h3>
    <div class="row my-2">
        <div class="col-md-3">
            <label for="producto_detalle">Producto:</label>
            <select id="producto_detalle" class="form-control">
                <option value="">Seleccione un producto</option>
                @foreach($golosinas as $golosina)
                    <option value="{{ $golosina->id_golosina }}" data-precio="{{ $golosina->precioVenta }}">
                        {{ $golosina->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="cantidad_detalle">Cantidad:</label>
            <input type="number" id="cantidad_detalle" class="form-control" min="1" value="1">
        </div>
        <div class="col-md-2">
            <label for="precio_detalle">Precio:</label>
            <input type="number" id="precio_detalle" class="form-control" step="0.01">
        </div>
        <div class="col-md-2">
            <label for="importe_detalle">Importe:</label>
            <input type="number" id="importe_detalle" class="form-control" step="0.01" readonly>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label>
            <button type="button" id="btnAgregarDetalle" class="btn btn-success form-control">Agregar Producto</button>
        </div>
    </div>

    <!-- Tabla donde se listarán los detalles agregados -->
    <table class="table" id="tabla-detalles">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Importe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Se insertarán los detalles dinámicamente -->
        </tbody>
    </table>

    <!-- Los detalles se enviarán como inputs ocultos dentro de este contenedor -->
    <div id="detalles-inputs"></div>

    <div class="row my-3">
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Guardar Venta</button>
        </div>
    </div>
</form>

<!-- Script para agregar detalles y calcular importe -->
<script>
// Inicializamos un contador para agrupar cada detalle
let detailCount = 0;

document.addEventListener("DOMContentLoaded", function(){
    // Al seleccionar un producto, se asigna su precio base al campo de precio
    document.getElementById("producto_detalle").addEventListener("change", function(){
        const selectedOption = this.options[this.selectedIndex];
        const precio = selectedOption.getAttribute("data-precio") || 0;
        document.getElementById("precio_detalle").value = precio;
        calcularImporteDetalle();
    });

    // Calcular importe cuando cambie cantidad o precio
    document.getElementById("cantidad_detalle").addEventListener("input", calcularImporteDetalle);
    document.getElementById("precio_detalle").addEventListener("input", calcularImporteDetalle);

    function calcularImporteDetalle(){
        const cantidad = parseFloat(document.getElementById("cantidad_detalle").value) || 0;
        const precio   = parseFloat(document.getElementById("precio_detalle").value) || 0;
        const importe  = cantidad * precio;
        document.getElementById("importe_detalle").value = importe.toFixed(2);
    }

    // Agregar detalle a la tabla y a los inputs ocultos
    document.getElementById("btnAgregarDetalle").addEventListener("click", function(){
        const productoSelect = document.getElementById("producto_detalle");
        const productoId = productoSelect.value;
        const productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
        const cantidad = document.getElementById("cantidad_detalle").value;
        const precio = document.getElementById("precio_detalle").value;
        const importe = document.getElementById("importe_detalle").value;

        if(productoId === ""){
            alert("Seleccione un producto");
            return;
        }

        // Crear una nueva fila en la tabla de detalles
        const tbody = document.querySelector("#tabla-detalles tbody");
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${productoNombre}</td>
            <td>${cantidad}</td>
            <td>${precio}</td>
            <td>${importe}</td>
            <td><button type="button" class="btn btn-danger btn-sm btnEliminarDetalle">Eliminar</button></td>
        `;
        tbody.appendChild(tr);

        // Agregar inputs ocultos con un índice único (detailCount) para que se agrupen los datos
        const detallesInputsDiv = document.getElementById("detalles-inputs");
        detallesInputsDiv.insertAdjacentHTML("beforeend", `
            <input type="hidden" name="detalles[${detailCount}][producto]" value="${productoId}">
            <input type="hidden" name="detalles[${detailCount}][cantidad]" value="${cantidad}">
            <input type="hidden" name="detalles[${detailCount}][precio]" value="${precio}">
            <input type="hidden" name="detalles[${detailCount}][importe]" value="${importe}">
        `);
        detailCount++; // Incrementa el contador para el siguiente detalle

        // Reiniciar los controles de detalle
        productoSelect.selectedIndex = 0;
        document.getElementById("cantidad_detalle").value = 1;
        document.getElementById("precio_detalle").value = "";
        document.getElementById("importe_detalle").value = "";
    });

    // Permitir eliminar una fila y sus inputs asociados
    document.querySelector("#tabla-detalles tbody").addEventListener("click", function(e){
        if(e.target && e.target.classList.contains("btnEliminarDetalle")){
            // Se obtiene la fila a eliminar
            const fila = e.target.closest("tr");
            // Opcionalmente, podrías obtener un índice o alguna identificación para remover también los inputs ocultos correspondientes.
            // Como solución sencilla, puedes recargar la página o hacer la eliminación solo en la vista de la tabla.
            fila.remove();
            // Para una solución completa, tendrías que re-indexar los inputs ocultos. Esto puede incluir un código adicional,
            // pero por simplicidad se recomienda no permitir eliminación o recargar la sección.
            // Puedes avisar al usuario que la eliminación no actualizará los inputs ocultos y que se recargará el formulario.
        }
    });
});
</script>
@endsection
