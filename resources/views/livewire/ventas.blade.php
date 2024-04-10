<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($editarShow == 1)
        <div class="container">
            <form wire:submit.prevent="guardarVenta">
                <div class="row ">
                    <h1 class="mt-3 mb-5">Nueva Venta</h1>
                    <hr>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <h4>Sobre la compra</h4>
                        <p>La factura saldrá con los datos del cliente.</p>
                        <div class="form-group">
                            <label for="cliente_id">Cliente:</label>
                            <select wire:model.live="cliente_id" class="form-control" id="cliente_id">
                                @foreach ($Cliente as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->denominacion }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="tipo_estado_tipos_id">Tipo de venta:</label>
                            <select wire:model.live="tipo_estado_tipos_id" class="form-control"
                                id="tipo_estado_tipos_id">
                                @foreach ($TipoEstadoVenta as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('tipo_estado_tipos_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <h4>Agregar productos</h4>
                        <p>Selecciona el producto, ingresa la cantidad y presiona en agregar al carrito.</p>
                        <div class="form-group">
                            <label for="idSelect">Producto:</label>
                            <select wire:model.live="idSelect" class="form-control" id="idSelect">
                                @foreach ($Producto as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            @error('idSelect')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" wire:model="cantidad" class="form-control" id="cantidad"
                                min="0">
                            @error('cantidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="button" class="btn btn-dark" wire:click="agregarCarrito">Añadir al
                                carrito</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <br> <br>
                        @if (count($carrito))
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carrito as $index => $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $item['descripcion'] }}</td>
                                                <td>{{ $item['precio'] }}</td>
                                                <td>{{ $item['cantidad'] }}</td>
                                                <td>{{ $item['subtotal'] }}</td>
                                                <td>
                                                    <a class="btn btn-danger"
                                                        wire:click="BorrarCarrito({{ $index }})">Eliminar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                        @endif

                        <div class="d-flex align-items-end flex-column mb-3">
                            <div class="col-6">
                                <br>
                                <hr>
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td scope="col">Total de productos</td>
                                            <td scope="col">{{ count($carrito) }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Precio subtotal</td>
                                            <td scope="col">{{ $sumasubtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Descuento</td>
                                            <td scope="col">0</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Igv 18%</td>
                                            <td scope="col">{{ $igv }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Total a pagar</td>
                                            <td scope="col">{{ $sumatotal }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="button" class="btn btn-secondary mx-2" wire:click="Cancelar">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="guardarVenta">Registrar
                            venta</button>
                    </div>
                </div>
            </form>
        </div>
    @elseif ($editarShow == 2)
        <div class="container">
            <div class="row justify-content-center" id="contenedor-imprimir">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="mt-3 mb-5">Factura</h1>

                    @if ($factura)


                        <div class="row g-4 py-5 row-cols-1 row-cols-lg-2">
                            <div class="feature col">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex ">
                                            <div class="me-auto p-2">Denominación</div>
                                            <div class="p-2">{{$factura->cliente->denominacion}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex ">
                                            <div class="me-auto p-2">Dirección</div>
                                            <div class="p-2">{{$factura->cliente->direccion}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <div class="me-auto p-2">Correo electrónico</div>
                                            <div class="p-2">{{$factura->cliente->email}}</div>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                            <div class="feature col">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="d-flex ">
                                            <div class="me-auto p-2">Código de cajero</div>
                                            <div class="p-2">Nro. 00000{{$factura->usuario->id}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex ">
                                            <div class="me-auto p-2">Vendedor</div>
                                            <div class="p-2">{{$factura->usuario->name}}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <div class="me-auto p-2">Fecha de venta</div>
                                            <div class="p-2">{{$factura->created_at}}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($factura->productos as $index => $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->producto->nombre }}</td>
                                            <td>{{ $item->producto->descripcion }}</td>
                                            <td>{{ $item->cantidad }}</td>
                                            <td>{{ $item->precio_unitario }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex align-items-end flex-column mb-3">
                            <div class="col-6">
                                <hr>
                                <table class="table table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td scope="col">Total de productos</td>
                                            <td scope="col">{{ $factura->productos->count() }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Precio subtotal</td>
                                            <td scope="col">{{ $factura->subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Descuento</td>
                                            <td scope="col">{{ $factura->descuento }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Igv 18%</td>
                                            <td scope="col">{{ $factura->igv }}</td>
                                        </tr>
                                        <tr>
                                            <td scope="col">Total a pagar</td>
                                            <td scope="col">{{ $factura->total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
            <button  onclick="imprimirContenedor('contenedor-imprimir')" class="btn btn-primary">Imprimir</button>

        </div>
    @else
        <h1 class="mt-3 mb-5">Ventas de mi tiendita</h1>
        <small class="d-block text-end mt-3 mb-5">
            <button type="button" class="btn btn-dark" wire:click="NuevoListener">
                Nueva Venta
            </button>
        </small>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Total</th>
                        <th scope="col">Situacion</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Venta as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->cliente->denominacion }}</td>
                            <td>{{ $item->usuario->name }}</td>
                            <td>{{ $item->total }}</td>
                            <td>{{ $item->tipoEstadoVenta->descripcion }}</td>
                            <td>
                                <a class="btn btn-primary"
                                    wire:click="EditarIdListener({{ $item->id }})">Factura</a>
                                {{-- <a class="btn btn-danger"
                                 wire:click="EliminarIdListener({{ $item->id }})">Eliminar</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

<script>
    function imprimirContenedor(id) {
        var contenido = document.getElementById(id).innerHTML;
        var ventanaImpresion = window.open('', '_blank');
        ventanaImpresion.document.write('<html><head><title>Contenido para Imprimir</title>');
        ventanaImpresion.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">');
        ventanaImpresion.document.write('</head><body>' + contenido + '</body></html>');
        ventanaImpresion.document.close();
        ventanaImpresion.print();
    }
</script>

</div>
