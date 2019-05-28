@extends('diseño.navbar')

@section('title','Nombre_usuario')

@section('content')

@include('ventanas.errors')
<?php $message = Session::get('message') ?>

@if ($message == 'store')
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        ¡producto registrado exitosamente!
    </div>
@endif
<!--Informacion del perfil de usuario-->
<div class="container-fluid" id="inforPerfil">
    <div class="row">
        <div class="col-10 col-sm-4">
            <div class=" card text-center" style="width: 20rem; margin-top: 50px;">
                <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="images/{{  Auth::user()->avatar }}" alt="">
                <div class="card-body">

                    <h5 class="card-title">{{ Auth::user()->nombre }}</h5>
                    <p class="card-text">Last name: {{ Auth::user()->apellido }}</p>
                    <p class="card-text">Email: {{ Auth::user()->correo }}</p>
                    <p class="card-text">Number phone: {{ Auth::user()->num_cel }}</p>
                    <a href="/editar/{{ Auth::user()->id  }}" class="btn btn-primary">Editar perfil</a>
                </div>
             </div>
        </div>  
        
<!--Registro de productos-->    
    <div class="col-10 col-sm-4" id="perfil" style="width: 20rem; margin-top: 40px;">
        <h5>Ahora puedes registrar tus productos</h5>

                    @include('perfil_Usuario.create')
    </div>
     
<!--Productos previamente publicados por el usuario-->
    <div class="container-fluid" id="registrados">
        <hr>
            <h2>Productos registrados</h2>
            <h6>En este apartado podra visualizar los productos que haya registrado</h6>
    <div class="row">  
        {{-- productos del usuario --}}
        @foreach ($item as $dato)
        <div class="col-sm">
            <div class="card text-center" style="width: 18rem; margin-top: 40px;">
                    <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $dato->url }}" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{ $dato->nombre }}</h5>
                    <p class="card-text"><strong>Precio: ${{ $dato->precio }}</strong></p>
                    <p class="card-text"><strong>Descripción: {{ $dato->descripcion }}</strong></p>
                    <a href="/producto/{{ $dato->id  }}/editar" class="btn btn-primary">editar</a>
                    <a href="/producto/{{ $dato->id }}/borrar" class="btn btn-danger">Vendido</a>
                </div>
            </div>
        </div>    
        @endforeach
    </div>
</div>
<div class="container-fluid" id="registrados">
    <hr>
        <h2>Productos Vendidos</h2>
        <h6>En este apartado podra visualizar los productos Vendidos</h6>
<div class="row">  
    {{-- productos del usuario --}}
    @foreach ($itemSold as $sold)
    <div class="col-sm">
        <div class="card text-center" style="width: 18rem; margin-top: 40px;">
                <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $sold->url }}" alt="">
            <div class="card-body">
                <h5 class="card-title">{{ $sold->nombre }}</h5>
                <p class="card-text"><strong>Precio: ${{ $sold->precio }}</strong></p>
                <p class="card-text"><strong>Descripción: {{ $sold->descripcion }}</strong></p>
                <a href="/producto/{{ $sold->id  }}/editar" class="btn btn-primary">editar</a>
                <a href="/producto/{{ $sold->id }}/ofrecer" class="btn btn-success">Ofrecer</a>
            </div>
        </div>
    </div>    
    @endforeach
</div>
</div>
{{-- comment --}}

</div>

<script src="{{ asset('js/logica.js') }}"></script>


@endsection