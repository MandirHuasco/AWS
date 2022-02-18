@extends("layouts.app")
@section("content")
    <div class="container opacity-animation-4">
        <div class="box-img">
            <img class="card-img-top img-perfil" src="/img/gestion-almacenes.png" alt="Card image cap">
        </div>
        <div class="row justify-content-center margin-top-50">
            <div class="card" style="width: 900px;">
                @if(session('status'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Felicidades!</strong> Actualizaste con exito tu perfil.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @foreach($user as $usuario)
                    <div>
                        <button type="button" class="btn btn-warning button-inventario" onclick="location.href='/inventario'">Inventario</button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{$usuario['name']}} {{$usuario['apellido']}}</h5>
                        <p class="card-text">Este es su perfil principal puede editar sus datos desde esta pestaña.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cargo: {{$usuario['cargo']}}</li>
                        <li class="list-group-item">Estado: {{$usuario['estado']}}</li>
                        <li class="list-group-item">Email: {{$usuario['email']}}</li>
                    </ul>
                    <div class="card-body">
                        <button class="btn btn-warning" data-toggle="collapse" href="#multiCollapse1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Editar</button>
                        <button class="btn btn-warning" onclick="location.href='/producto'">Agregar producto</button>
                        <div class="row">
                            <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapse1">
                                    <div class="card-body" style="background: #f9f9f9; margin-top: 20px;">
                                        <h4>Perfil <span class="badge badge-secondary">Editar</span></h4>
                                        <hr class="my-4">
                                        <form action="/actualizar" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{$usuario['email']}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputAddress">Nombre</label>
                                                    <input type="text" class="form-control" name="name" value="{{$usuario['name']}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputCity">Ciudad</label>
                                                    <input type="text" class="form-control" name="ciudad" value="{{$usuario['ciudad']}}">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputZip">Código</label>
                                                    <input type="text" class="form-control" name="codigo" value="{{$usuario['codigo']}}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
