@extends('diseño.interfaz')

@section('title','Inicio')

@section('content')
<!--Productos publicados mostrados en la pagina principal-->
<div class="container" id="principal">
    <center>
      {{ Form::open(['route'=>['search'], 'method'=>'post', 'role' => 'search']) }}
      {{ Form::text('search',old('search'),array('placeholder'=>'Buscar producto')) }}      
      {{ Form::submit('buscar') }}
    </center>
      {{ Form::close() }}
    
        <div class="row">
            @foreach ($data as $producto)

            <div class="col-sm">
                <div class="card text-center" style="width: 18rem; margin-top: 40px;">
                                <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $producto->url }}" alt="">                          
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->alt }}</h5>
                                <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}.00</p>


                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#producto-{{ $producto->id }}">Ver mas</button>

                            <div class="modal fade" id="producto-{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">{{ $producto->alt }}</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body container">
                                      {{-- Producto --}}
                                      <center><h4>Datos del Vendedor</h4></center>      
                                      <div class="row">
                                              
                                                <div class="col-6">
                                                        <center>
                                                                        <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="productos/{{ $producto->url }}" alt="{{ $producto->alt }}">                          
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">{{ $producto->alt }}</h5>
                                                                        <p class="card-text"><strong>Precio:</strong> ${{ $producto->precio }}.00</p>
                                                                        <p class="card-text"><strong>Descripción:</strong>{{ $producto->descripcion }}</p>
                                                                </div>
                                                            
                                                        </center>
                                                </div>
                                                
                                                <div class="col-6">
                                                        <center>
                                                          <img class="card-img-top rounded-circle mx-auto d-block" style="height: 200px; width: 200px; background-color: #EFEFEF;" src="images/{{  $producto->avatar }}" alt="{{ $producto->nombre }} {{ $producto->apellido }}">
                                                          <div class="card-body">
                                          
                                                              <h5 class="card-title">{{ $producto->nombre }} {{ $producto->apellido }}</h5>
                                                              <p class="card-text">Correo Electronico:<strong> {{ $producto->correo }}</strong></p>
                                                              <p class="card-text">Numero Telefonico:<br><strong> {{ $producto->num_cel }}</strong></p>
                                                          </div>
                                                </center>
                                                    
                                        </div>
                                                
                                            </div>
                                      {{-- Producto--}}
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
        

</div>

@endsection