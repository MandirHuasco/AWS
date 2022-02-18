@extends("layouts.app")
@section("content")
    <div class="container w-max">
        <div class="row justify-content-center">
            <div class="display-grid padding-left-rigth-20">
                <div class="card card-register">
                    <div class="card-header">
                        <img class="img-entradas" src="/img/Logo-Entradas.png"/>
                    </div>

                    <div class="card-body text-white">
                        <form method="POST" action="/entradas" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="factura" class="col-md-4 col-form-label text-md-right">Factura</label>
                                <div class="col-md-6">
                                    <select aria-label="Default select example" class="form-control @error('factura') is-invalid @enderror" name="factura">
                                        @foreach($resultadoFact as $factura)
                                            @if($factura['ent_sal_fact']=='Entrada')
                                                <option value="{{$factura['id']}}">{{$factura['nro_fact']}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('factura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="producto" class="col-md-4 col-form-label text-md-right">Producto</label>
                                <div class="col-md-6">
                                    <select aria-label="Default select example" class="form-control @error('producto') is-invalid @enderror" name="producto">
                                        @foreach($resultadoPro as $producto)
                                            <option value="{{$producto['id']}}">{{$producto['nom_pro']}}</option>
                                        @endforeach
                                    </select>

                                    @error('producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cantidad" class="col-md-4 col-form-label text-md-right">Cantidad</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" value="{{ old('cantidad') }}" required autocomplete="cantidad" autofocus>
                                    @foreach($resultado as $user)
                                        <input type="hidden" name="entr_id_user" value="{{$user["id"]}}">
                                    @endforeach
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="precio" class="col-md-4 col-form-label text-md-right">Precio [S/.]</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <input id="precio" type="number" step="0.000000000001" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-fact">Soles</span>
                                        </div>
                                    </div>

                                    @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="desc_entr" class="col-md-4 col-form-label text-md-right">Descuento</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <input id="desc_entr" type="number" value="0" step="0.000000000001" class="form-control @error('desc_entr') is-invalid @enderror" name="desc_entr" value="{{ old('desc_entr') }}" required autocomplete="desc_entr" autofocus>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-fact">%</span>
                                        </div>
                                    </div>

                                    @error('desc_entr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="flete_unidad" class="col-md-4 col-form-label text-md-right">Flete Unidad</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <input id="flete_unidad" type="number" value="0" step="0.000000000001" class="form-control @error('flete_unidad') is-invalid @enderror" name="flete_unidad" value="{{ old('flete_unidad') }}" required autocomplete="flete_unidad" autofocus>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-fact">Soles</span>
                                        </div>
                                    </div>

                                    @error('flete_unidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="recargo_porcentaje_entr" class="col-md-4 col-form-label text-md-right">Recargo</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <input id="recargo_porcentaje_entr" value="0" type="number" step="0.000000000001" class="form-control @error('recargo_porcentaje_entr') is-invalid @enderror" name="recargo_porcentaje_entr" value="{{ old('recargo_porcentaje_entr') }}" required autocomplete="recargo_porcentaje_entr" autofocus>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-fact">%</span>
                                        </div>
                                    </div>

                                    @error('recargo_porcentaje_entr')
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

                <main class="main-table-scroll">
                    @if(session('status'))
                        @if(session('status')=='Entrada create!')
                            <div class="alert alert-warning alert-dismissible fade show margin-top-20" role="alert">
                                <strong>Felicidades!</strong> Entrada creada con éxito.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Entrada desactivate!')
                            <div class="alert alert-danger alert-dismissible fade show margin-top-20" role="alert">
                                Entrada <strong>DESACTIVADO</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Entrada activate!')
                            <div class="alert alert-success alert-dismissible fade show margin-top-20" role="alert">
                                Entrada <strong>ACTIVADO</strong>
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
                            <th scope="col">Producto</th>
                            <th scope="col">Img Prod</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Total</th>
                            <th scope="col">Importe Desc</th>
                            <th scope="col">Valor de Compra</th>
                            <th scope="col">Flete Total</th>
                            <th scope="col">Total Recargo</th>
                            <th scope="col">Costo Adq Total</th>
                            <th scope="col">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($resultadoEntr)){
                                $resultadoEntr = collect($resultadoEntr)->sortBy('id')->reverse()->toArray();
                            }
                        ?>
                        @foreach($resultadoEntr as $entrada)
                            <tr class="table-cell"
                                @if($entrada['estado']=='Inactivo')
                                    style="background: #ff8100;"
                                @endif
                            >
                                <th scope="row">{{$entrada['id']}}</th>
                                <td>
                                    @foreach($resultadoPro as $producto)
                                        @if($entrada['prod_entr'] == $producto['id'])
                                            {{$producto['nom_pro']}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($resultadoPro as $producto)
                                        @if($entrada['prod_entr'] == $producto['id'])
                                            @if($producto['img_pro']=='')
                                                No imagen
                                            @else
                                                <img src="{{asset("storage/".$producto["img_pro"])}}" class="img_pro_entradas" alt="..."/>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$entrada['cant_entr']}}</td>
                                <td>s/.{{$entrada['pre_entr']}}</td>
                                <td>s/.{{$entrada['total_entr']}}</td>
                                <td>s/.{{$entrada['importe_desc_entr']}}</td>
                                <td>s/.{{$entrada['valor_compra_neto_entr']}}</td>
                                <td>s/.{{$entrada['flete_total_entr']}}</td>
                                <td>s/.{{$entrada['total_recargo_entr']}}</td>
                                <td>s/.{{$entrada['costo_adqu_total_entr']}}</td>
                                <td>
                                    <div class="custom-control custom-switch filter-invert">
                                        @if($entrada['estado']=='Activo')
                                            <form method='post' action='/entrada-desactivar' id="formActivate{{$entrada['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$entrada['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$entrada['id']}}" onchange="document.getElementById('formActivate{{$entrada['id']}}').submit()" checked>
                                                <label class="custom-control-label" for="{{$entrada['id']}}"><span class="badge badge-primary">{{$entrada['estado']}}</span></label>

                                            </form>
                                        @else
                                            <form method='post' action='/entrada-activar' id="formDesactivate{{$entrada['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$entrada['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$entrada['id']}}" onchange="document.getElementById('formDesactivate{{$entrada['id']}}').submit()">
                                                <label class="custom-control-label" for="{{$entrada['id']}}"><span class="badge badge-primary">{{$entrada['estado']}}</span></label>

                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </main>

            </div>
        </div>
    </div>
@endsection
