@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <h1>Examen práctico</h1>
</div>

<div class="row my-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Acerca del Proyecto</h5>
                <p class="card-text">Sistema creado para el examen de la U2 de "Desarrollo e Implementación de Sistemas de Información" 
                    en el <strong>Tecnológico Nacional de México, Campus Colima. Luis Daniel Montalván Gutiérrez</strong>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection