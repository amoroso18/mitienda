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
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">

                    <h1 class="mt-3 mb-5">Nuevo Producto</h1>

                    <form wire:submit.prevent="guardarProducto">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" wire:model="nombre" class="form-control" id="nombre">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion"></textarea>
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" wire:model="precio" class="form-control" id="precio"
                                step="0.01">
                            @error('precio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" wire:model="stock" class="form-control" id="stock" min="0">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipo_estado_tipos_id">Tipo:</label>
                            <select wire:model="tipo_estado_tipos_id" class="form-control" id="tipo_estado_tipos_id">
                                @foreach ($TipoProducto as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('tipo_estado_tipos_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-secondary mx-2"
                                wire:click="Cancelar">Cancelar</button>
                            <button type="button" class="btn btn-primary"
                                wire:click="guardarProducto">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($editarShow == 2)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">

                    <h1 class="mt-3 mb-5">Editar Producto</h1>

                    <form wire:submit.prevent="actualizarProducto">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" wire:model="nombre" class="form-control" id="nombre">
                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion"></textarea>
                            @error('descripcion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" wire:model="precio" class="form-control" id="precio"
                                step="0.01">
                            @error('precio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" wire:model="stock" class="form-control" id="stock" min="0">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipo_estado_tipos_id">Tipo:</label>
                            <select wire:model="tipo_estado_tipos_id" class="form-control" id="tipo_estado_tipos_id">
                                @foreach ($TipoProducto as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('tipo_estado_tipos_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-secondary mx-2"
                                wire:click="Cancelar">Cancelar</button>
                            <button type="button" class="btn btn-primary"
                                wire:click="actualizarProducto">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($editarShow == 3)
        <h1 class="mt-3 mb-5">Eliminar Producto</h1>
        <h4>¿Estas seguro que deseas elimiar este Producto?</h4>
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-secondary mx-2" wire:click="Cancelar">Cancelar</button>
            <button type="button" class="btn btn-danger" wire:click="BorrarCliente">Eliminar</button>
        </div>
    @else
        <h1 class="mt-3 mb-5">Almacén</h1>
        <small class="d-block text-end mt-3 mb-5">
            <button type="button" class="btn btn-dark" wire:click="NuevoListener">
                Nuevo Producto
            </button>
        </small>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descrip.</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Vendido</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->getTipoProducto->descripcion }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->precio }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->vendido }}</td>
                            <td>
                                <a class="btn btn-primary"
                                    wire:click="EditarIdListener({{ $item->id }})">Editar</a>
                                <a class="btn btn-danger"
                                    wire:click="EliminarIdListener({{ $item->id }})">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



</div>
