<div>
    <h1 class="mt-3 mb-5">Clientes</h1>
    <small class="d-block text-end mt-3 mb-5">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">
            + Cliente
        </button>
    </small>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Identificac.</th>
                    <th scope="col">Denominac.</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Telef.</th>
                    <th scope="col">Correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $item->getTipoCliente->descripcion }}</td>
                        <td>{{ $item->documento_identidad }}</td>
                        <td>{{ $item->codigo_documento }}</td>
                        <td>{{ $item->denominacion }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->telefono }}</td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div>

        <!-- Modal para agregar nuevo cliente -->
        <div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para agregar nuevo cliente -->
                        <form wire:submit.prevent="guardarCliente">
                            <div class="form-group">
                                <label for="tipo_documento_id">Tipo Cliente:</label>
                                <select wire:model="tipo_documento_id" class="form-control" id="tipo_documento_id">
                                    @foreach ($tiposCliente as $TIPO)
                                        <option value="{{ $TIPO->id }}">{{ $TIPO->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_documento_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="documento_identidad">Documento de Identidad:</label>
                                <input type="text" wire:model="documento_identidad" class="form-control" id="documento_identidad">
                                @error('documento_identidad') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="codigo_documento">Código de Documento:</label>
                                <input type="text" wire:model="codigo_documento" class="form-control" id="codigo_documento">
                                @error('codigo_documento') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="denominacion">Denominación:</label>
                                <input type="text" wire:model="denominacion" class="form-control" id="denominacion">
                                @error('denominacion') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" wire:model="direccion" class="form-control" id="direccion">
                                @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" wire:model="telefono" class="form-control" id="telefono">
                                @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" wire:model="email" class="form-control" id="email">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" wire:click="guardarCliente">Guardar</button>
                        <div class="mb-3 row"> 
                            <span wire:loading class="col-md-3 offset-md-5 text-primary">Processing...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Escuchar el evento 'clienteAgregado' emitido por Livewire
    document.addEventListener('livewire:clienteAgregado', () => {
        // Cerrar el modal
        $('#agregarClienteModal').modal('hide');
    });
</script>

</div>
