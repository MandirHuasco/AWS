@extends("layouts.app")
@section("content")
    <div class="container w-max">
        <div class="row justify-content-center">
            <div class="display-grid padding-left-rigth-20">

                @if(session('status'))
                    @if(session('status')=='Producto desactivate!')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Producto <strong>DESACTIVADO</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session('status')=='Producto activate!')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Producto <strong>ACTIVADO</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                @endif

                <main class="main-table-scroll">
                    <table class="table table-bordered table-dark margin-top-20">
                        <thead>
                        <tr class="bg-black">
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Img Prod</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Salida</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resultadoInv as $inventario)
                            <tr class="table-cell"
                                @if($inventario['estado']=='Inactivo')
                                style="background: #ff8100;"
                                @endif
                            >
                                <th scope="row">{{$inventario['id']}}</th>
                                <td>{{$inventario['prod_inv']}}</td>
                                <td>
                                    @foreach($resultadoPro as $producto)
                                        @if($inventario['inv_id_productos'] == $producto['id'])
                                            @if($producto['img_pro']=='')
                                                No imagen
                                            @else
                                                <img src="{{asset("storage/".$producto["img_pro"])}}" class="img_pro_entradas" alt="..."/>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$inventario['entrada_inv']}}</td>
                                <td>{{$inventario['salida_inv']}}</td>
                                <td>{{$inventario['stock_inv']}}</td>
                                <td>s/.{{$inventario['precio_inv']}}</td>
                                <td>s/.{{$inventario['importe_inv']}}</td>
                                <td>
                                    <div class="custom-control custom-switch filter-invert">
                                        @if($inventario['estado']=='Activo')
                                            <form method='post' action='/inventario-desactivar' id="formActivate{{$inventario['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$inventario['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$inventario['id']}}" onchange="document.getElementById('formActivate{{$inventario['id']}}').submit()" checked>
                                                <label class="custom-control-label" for="{{$inventario['id']}}"><span class="badge badge-primary">{{$inventario['estado']}}</span></label>

                                            </form>
                                        @else
                                            <form method='post' action='/inventario-activar' id="formDesactivate{{$inventario['id']}}">
                                                @csrf

                                                <input type='hidden' name='id' value='{{$inventario['id']}}'>
                                                <input type="checkbox" class="custom-control-input" id="{{$inventario['id']}}" onchange="document.getElementById('formDesactivate{{$inventario['id']}}').submit()">
                                                <label class="custom-control-label" for="{{$inventario['id']}}"><span class="badge badge-primary">{{$inventario['estado']}}</span></label>

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
