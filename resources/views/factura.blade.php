@extends("layouts.app")
@section("content")
    <div class="container w-max">
        <div class="row justify-content-center">
            <div class="display-grid padding-left-rigth-20">
                <div class="card card-register">
                    <div class="card-header">
                        <img class="img-fact-bol" src="/img/Logo-Facturas.png"/>
                    </div>

                    <div class="card-body text-white">
                        <div class="form-group row justify-content-center">
                            <label for="ent-sal-fact" class="col-form-label text-center padding-rigth-20">Seleccione: Entrada o Salida</label>

                            <div class="display-content">
                                <button class="btn btn-warning bg-fact" data-toggle="collapse" href="#Entrada" role="button" aria-expanded="false" aria-controls="Entrada">Entrada</button>
                                <button class="btn btn-warning bg-fact" data-toggle="collapse" href="#Salida" role="button" aria-expanded="false" aria-controls="Salida">Salida</button>

                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse" id="Entrada">
                                            <div class="card-body" style="margin-top: 20px;">
                                                <h4>ENTRADA<span class="badge badge-primary margin-left-10">seleccionado</span></h4>
                                                <hr class="my-4">
                                                <form method="POST" action="/facturas" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type='hidden' name='fact_Bol' value='Factura'>

                                                    <div class="form-group row">
                                                        <label for="nro_fact" class="col-md-4 col-form-label text-md-right">Número de factura</label>

                                                        <div class="col-md-6">
                                                            <input id="nro_fact" type="text" class="form-control @error('nro_fact') is-invalid @enderror" name="nro_fact" value="{{ old('nro_fact') }}" required autocomplete="nro_fact" autofocus>

                                                            @error('nro_fact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nom_prov" class="col-md-4 col-form-label text-md-right">Nombre Proveedor</label>

                                                        <div class="col-md-6">
                                                            <input id="nom_prov" type="text" class="form-control @error('nom_prov') is-invalid @enderror" name="nom_prov" value="{{ old('nom_prov') }}" required autocomplete="nom_prov" autofocus>

                                                            <input type='hidden' name='nom_cli' value='NA'>
                                                            <input type='hidden' name='fecha' value="<?php date_default_timezone_set('America/Lima');  echo date('d-m-Y');?>">
                                                            <input type='hidden' name='ent-sal-fact' value='Entrada'>

                                                            @foreach($resultado as $user)
                                                                <input type='hidden' name='nom_em' value='{{$user['name']}} {{$user['apellido']}}'>
                                                                <input type='hidden' name='fact_id_user' value='{{$user['id']}}'>
                                                            @endforeach

                                                            @error('nom_prov')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
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
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="collapse multi-collapse" id="Salida">
                                            <div class="card-body" style="margin-top: 20px;">
                                                <h4>SALIDA<span class="badge badge-primary margin-left-10">seleccionado</span></h4>
                                                <hr class="my-4">
                                                <form method="POST" action="/facturas" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <label for="factura" class="col-md-4 col-form-label text-md-right">Factura/Boleta</label>
                                                        <div class="col-md-6">
                                                            <select aria-label="Default select example" class="form-control @error('factura') is-invalid @enderror" name="fact_Bol">
                                                                <option value="Factura">Factura</option>
                                                                <option value="Boleta">Boleta</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nro_fact" class="col-md-4 col-form-label text-md-right">Número de factura</label>

                                                        <div class="col-md-6">
                                                            <input id="nro_fact" type="text" class="form-control @error('nro_fact') is-invalid @enderror" name="nro_fact" value="{{ old('nro_fact') }}" required autocomplete="nro_fact" autofocus>

                                                            @error('nro_fact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="nom_cli" class="col-md-4 col-form-label text-md-right">Nombre Cliente</label>

                                                        <div class="col-md-6">
                                                            <input id="nom_cli" type="text" class="form-control @error('nom_cli') is-invalid @enderror" name="nom_cli" value="{{ old('nom_cli') }}" required autocomplete="nom_cli" autofocus>

                                                            <input type='hidden' name='nom_prov' value='NA'>
                                                            <input type='hidden' name='fecha' value="<?php date_default_timezone_set('America/Lima');  echo date('d-m-Y');?>">
                                                            <input type='hidden' name='ent-sal-fact' value='Salida'>
                                                            @foreach($resultado as $user)
                                                                <input type='hidden' name='nom_em' value='{{$user['name']}} {{$user['apellido']}}'>
                                                                <input type='hidden' name='fact_id_user' value='{{$user['id']}}'>
                                                            @endforeach

                                                            @error('nom_cli')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                            @enderror
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
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

                <main class="main-table-scroll">
                    @if(session('status'))
                        @if(session('status')=='Factura create!')
                            <div class="alert alert-warning alert-dismissible fade show margin-top-20" role="alert">
                                <strong>Felicidades!</strong> Factura creada con éxito.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Factura desactivate!')
                            <div class="alert alert-danger alert-dismissible fade show margin-top-20" role="alert">
                                Factura <strong>DESACTIVADO</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Factura activate!')
                            <div class="alert alert-success alert-dismissible fade show margin-top-20" role="alert">
                                Factura <strong>ACTIVADO</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    @endif
                    <table class="table table-bordered table-dark margin-top-20">
                        <thead>
                        <tr class="bg-black">
                            <th scope="col">ID</th>
                            <th scope="col">Nro Fact</th>
                            <th scope="col">Entrada/Salida</th>
                            <th scope="col">Factura/Boleta</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Trabajador</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resultadoFact as $factura)
                            <tr class="table-cell"
                                @if($factura['estado']=='Inactivo')
                                    style="background: #ff8100;"
                                @endif
                            >
                                <th scope="row">{{$factura['id']}}</th>
                                <td>{{$factura['nro_fact']}}</td>
                                <td>{{$factura['ent_sal_fact']}}</td>
                                <td>{{$factura['fact_Bol']}}</td>
                                <td>{{$factura['nom_cli']}}</td>
                                <td>{{$factura['nom_prov']}}</td>
                                <td>{{$factura['nom_em']}}</td>
                                <td>{{$factura['fecha_fac']}}</td>
                                <td>
                                    <div class="custom-control custom-switch filter-invert">
                                        @if($factura['estado']=='Activo')
                                            <form method='post' action='/factura-desactivar' id="formActivate{{$factura['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$factura['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$factura['id']}}" onchange="document.getElementById('formActivate{{$factura['id']}}').submit()" checked>
                                                <label class="custom-control-label" for="{{$factura['id']}}"><span class="badge badge-primary">{{$factura['estado']}}</span></label>

                                            </form>
                                        @else
                                            <form method='post' action='/factura-activar' id="formDesactivate{{$factura['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$factura['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$factura['id']}}" onchange="document.getElementById('formDesactivate{{$factura['id']}}').submit()">
                                                <label class="custom-control-label" for="{{$factura['id']}}"><span class="badge badge-primary">{{$factura['estado']}}</span></label>

                                            </form>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <buttom type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCenter{{$factura->id}}">Editar</buttom>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade" id="ModalCenter{{$factura->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Factura | Boleta <span class="badge badge-warning">Editar</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="/factura-update" method="POST">
                                            @csrf
                                            <div class="modal-body" id="#ModalEdit{{$factura->id}}">

                                                <input type='hidden' name='id' value='{{$factura['id']}}'>

                                                <div class="form-group row">
                                                    <label for="factura" class="col-md-4 col-form-label text-md-right">FACTURA</label>
                                                    <div class="col-md-6">
                                                        <select aria-label="Default select example" class="form-control @error('factura') is-invalid @enderror" name="fact_Bol">
                                                            <option
                                                                value="Factura"
                                                                @if($factura['fact_Bol'] == "Factura")
                                                                    selected
                                                                @endif
                                                            >Factura</option>
                                                            <option
                                                                value="Boleta"
                                                                @if($factura['fact_Bol'] == "Boleta")
                                                                selected
                                                                @endif
                                                            >Boleta</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row" >
                                                    <label for="nro_fact" class="col-md-4 col-form-label text-md-right">Número de factura</label>

                                                    <div class="col-md-6">
                                                        <input id="nro_fact" type="text" class="form-control @error('nro_fact') is-invalid @enderror" name="nro_fact" value="{{ $factura->nro_fact }}" required autocomplete="nro_fact" autofocus>

                                                        @error('nro_fact')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="nom_prov" class="col-md-4 col-form-label text-md-right">Nombre Proveedor</label>

                                                    <div class="col-md-6">
                                                        <input id="nom_prov" type="text" class="form-control @error('nom_prov') is-invalid @enderror" name="nom_prov" value="{{ $factura->nom_prov }}" required autocomplete="nom_prov" autofocus>

                                                        <input type='hidden' name='nom_cli' value='NA'>
                                                        <input type='hidden' name='fecha' value="<?php date_default_timezone_set('America/Lima');  echo date('d-m-Y');?>">
                                                        <input type='hidden' name='ent-sal-fact' value='Entrada'>
                                                        @foreach($resultado as $user)
                                                            <input type='hidden' name='nom_em' value='{{$user['name']}} {{$user['apellido']}}'>
                                                            <input type='hidden' name='fact_id_user' value='{{$user['id']}}'>
                                                        @endforeach

                                                        @error('nom_prov')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong class="alert-form">{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <div class="row">
                                                    <div class="col-md-12" >
                                                        <div class="float-end">
                                                            <button type="submit" class="btn btn-success">Guardar</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>

                </main>


            </div>
        </div>
    </div>
@endsection


