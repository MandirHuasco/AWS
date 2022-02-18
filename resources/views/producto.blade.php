@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 display-grid">
                <div class="card card-register">
                    <div class="card-header">
                        <img class="img-productos" src="/img/Logo-Productos.png"/>
                    </div>

                    <div class="card-body text-white">
                        <form method="POST" action="/producto" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="producto" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del Producto') }}</label>

                                <div class="col-md-6">
                                    <input id="producto" type="text" class="form-control @error('producto') is-invalid @enderror" name="producto" value="{{ old('producto') }}" required autocomplete="producto" autofocus>

                                    @error('producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="desc" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required autocomplete="desc" autofocus>
                                    @foreach($resultado as $user)
                                        <input type="hidden" name="pro_id_user" value="{{$user["id"]}}">
                                    @endforeach
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row img-group">
                                <label for="file" class="col-md-4 col-form-label text-md-right">IMAGEN (opcional)</label>

                                <div class="input-file input-file--reverse">
                                    <input type="file" id="file" class="file-img" name="img">
                                    <label class="aviso">
                                        <span class="error_span">{{$errors->first('img')}}</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-light">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <main>
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        @if(session('status'))
                            @if(session('status')=='Product create!')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Felicidades!</strong> Producto creado con éxito.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(session('status')=='Product desactivate!')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Producto <strong>DESACTIVADO</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @elseif(session('status')=='Product activate!')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Producto <strong>ACTIVADO</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        @endif
                        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                            <?php
                                if(!empty($resultadoPro)){
                                    $resultadoPro = collect($resultadoPro)->sortBy('id')->reverse()->toArray();
                                }
                            ?>
                            @foreach($resultadoPro as $pro)
                                <div class="col">
                                    <div class="card h-100 shadow-sm">
                                        @if($pro["img_pro"]!='')
                                            <img src="{{asset("storage/".$pro["img_pro"])}}" class="card-img-top card-img-prod" alt="..."/>
                                        @endif
                                        <div class="card-body aling-items-center display-grid">
                                            <div class="clearfix mb-3"> <span class="float-start badge rounded-pill bg-primary">{{$pro["estado"]}}</span> <span class="float-end price-hp">{{$pro["nom_pro"]}}</span> </div>
                                            <h5 class="card-title">{{$pro["desc_pro"]}}</h5>
                                            <div class="text-center my-4">
                                                @if($pro['estado']=='Activo')
                                                    <form method='post' action='/producto-desactivar'>
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$pro['id']}}'>
                                                        <input type="submit" class="btn btn-warning" value="Activo">
                                                    </form>
                                                @else
                                                    <form method='post' action='/producto-activar'>
                                                        @csrf
                                                        <input type='hidden' name='id' value='{{$pro['id']}}'>
                                                        <input type="submit" class="btn btn-danger" value="Inactivo">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </main>


            </div>
        </div>
    </div>
@endsection
