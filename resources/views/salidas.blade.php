@extends("layouts.app")
@section("content")
    <div class="container w-max">
        <div class="row justify-content-center">
            <div class="display-grid padding-left-rigth-20">
                <div class="card card-register">
                    <div class="card-header">
                        <img class="img-salidas" src="/img/Logo-Salidas.png"/>
                    </div>

                    <div class="card-body text-white">
                        <form method="POST" action="/salidas" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="factura" class="col-md-4 col-form-label text-md-right">Factura/Boleta</label>
                                <div class="col-md-6">
                                    <select aria-label="Default select example" class="form-control @error('factura') is-invalid @enderror" name="factura">
                                        @foreach($resultadoFact as $factura)
                                            @if($factura['ent_sal_fact']=='Salida')
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
                                <label for="igv" class="col-md-4 col-form-label text-md-right">IGV</label>
                                <div class="col-md-6">
                                    <select aria-label="Default select example" class="form-control @error('igv') is-invalid @enderror" name="igv">
                                        <option value="18">Con IGV</option>
                                        <option value="1">Sin IGV</option>
                                    </select>

                                    @error('igv')
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
                                        <input type="hidden" name="sal_id_user" value="{{$user["id"]}}">
                                    @endforeach
                                    @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="alert-form">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="margen_ganancia" class="col-md-4 col-form-label text-md-right">Ganancia</label>

                                <div class="col-md-6">
                                    <div class="input-group-prepend">
                                        <input id="margen_ganancia" type="number" value="0" step="0.000000000001" class="form-control @error('margen_ganancia') is-invalid @enderror" name="margen_ganancia" value="{{ old('margen_ganancia') }}" required autocomplete="margen_ganancia" autofocus>

                                        <div class="input-group-append">
                                            <span class="input-group-text bg-fact">%</span>
                                        </div>
                                    </div>

                                    @error('margen_ganancia')
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
                        @if(session('status')=='Salida create!')
                            <div class="alert alert-warning alert-dismissible fade show margin-top-20" role="alert">
                                <strong>Felicidades!</strong> Salida creada con éxito.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Salida desactivate!')
                            <div class="alert alert-danger alert-dismissible fade show margin-top-20" role="alert">
                                Salida <strong>DESACTIVADO</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Salida activate!')
                            <div class="alert alert-success alert-dismissible fade show margin-top-20" role="alert">
                                Salida <strong>ACTIVADO</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session('status')=='Stock menor a cero')
                            <div class="alert alert-red alert-dismissible fade show margin-top-20" role="alert">
                                salida <strong>STOCK MENOR A CERO</strong>
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
                            <th scope="col">Margen %</th>
                            <th scope="col">Valor Total</th>
                            <th scope="col">IGV Unid</th>
                            <th scope="col">IGV Total</th>
                            <th scope="col">Precio Venta</th>
                            <th scope="col">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($resultadoSal)){
                                $resultadoSal = collect($resultadoSal)->sortBy('id')->reverse()->toArray();
                            }
                        ?>
                        @foreach($resultadoSal as $salida)
                            <tr class="table-cell"
                                @if($salida['estado']=='Inactivo')
                                style="background: #ff8100;"
                                @endif
                            >
                                <th scope="row">{{$salida['id']}}</th>
                                <td>
                                    @foreach($resultadoPro as $producto)
                                        @if($salida['prod_sal'] == $producto['id'])
                                            {{$producto['nom_pro']}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($resultadoPro as $producto)
                                        @if($salida['prod_sal'] == $producto['id'])
                                            @if($producto['img_pro']=='')
                                                No imagen
                                            @else
                                                <img src="{{asset("storage/".$producto["img_pro"])}}" class="img_pro_entradas" alt="..."/>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$salida['cant_sal']}}</td>
                                <td>s/.{{$salida['pre_sal']}}</td>
                                <td>s/.{{$salida['total_sal']}}</td>
                                <td>{{$salida['margen_ganancia_porcentaje_sal']}}</td>
                                <td>s/.{{$salida['valor_total_sal']}}</td>
                                <td>s/.{{$salida['IGV_unit_sal']}}</td>
                                <td>s/.{{$salida['IGV_total_sal']}}</td>
                                <td>s/.{{$salida['precio_publico_unid_sal']}}</td>
                                <td>
                                    <div class="custom-control custom-switch filter-invert">
                                        @if($salida['estado']=='Activo')
                                            <form method='post' action='/salida-desactivar' id="formActivate{{$salida['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$salida['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$salida['id']}}" onchange="document.getElementById('formActivate{{$salida['id']}}').submit()" checked>
                                                <label class="custom-control-label" for="{{$salida['id']}}"><span class="badge badge-primary">{{$salida['estado']}}</span></label>

                                            </form>
                                        @else
                                            <form method='post' action='/salida-activar' id="formDesactivate{{$salida['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$salida['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$salida['id']}}" onchange="document.getElementById('formDesactivate{{$salida['id']}}').submit()">
                                                <label class="custom-control-label" for="{{$salida['id']}}"><span class="badge badge-primary">{{$salida['estado']}}</span></label>

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

