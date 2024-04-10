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
    @if ($editarShow)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-8 col-lg-6 col-xl-6">
                    <h1 class="mt-3 mb-5">Edita Cliente</h1>
                    <form wire:submit.prevent="EditarCliente">
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
                            <input type="text" wire:model="documento_identidad" class="form-control"
                                id="documento_identidad">
                            @error('documento_identidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="codigo_documento">Código de Documento:</label>
                            <input type="text" wire:model="codigo_documento" class="form-control"
                                id="codigo_documento" required>
                            @error('codigo_documento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="denominacion">
                                Nombres y Apellidos ó Denominación:
                            </label>
                            <input type="text" wire:model="denominacion" class="form-control" id="denominacion"
                                required>
                            @error('denominacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" wire:model="direccion" class="form-control" id="direccion">
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" wire:model="telefono" class="form-control" id="telefono">
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" wire:model="email" class="form-control" id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-secondary mx-2"
                                wire:click="CancelarEdicion">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="EditarCliente">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <h1 class="mt-3 mb-5">Clientes</h1>
        <small class="d-block text-end mt-3 mb-5">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#agregarClienteModal">
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
                        <th scope="col"></th>
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
                            <td>
                                <a class="btn btn-primary"
                                    wire:click="EditarIdListener({{ $item->id }})">Editar</a>
                                <a class="btn btn-danger" wire:click="AsignarIdListener({{ $item->id }})"
                                    data-bs-toggle="modal" data-bs-target="#BorrarModal">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

    <div class="modal fade" id="agregarClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <input type="text" wire:model="documento_identidad" class="form-control"
                                id="documento_identidad">
                            @error('documento_identidad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="codigo_documento">Código de Documento:</label>
                            <input type="text" wire:model="codigo_documento" class="form-control"
                                id="codigo_documento" required>
                            @error('codigo_documento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="denominacion">
                                Nombres y Apellidos ó Denominación:
                            </label>
                            <input type="text" wire:model="denominacion" class="form-control" id="denominacion"
                                required>
                            @error('denominacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" wire:model="direccion" class="form-control" id="direccion">
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" wire:model="telefono" class="form-control" id="telefono">
                            @error('telefono')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" wire:model="email" class="form-control" id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal-add-client-button"
                        data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                    <button type="submit" class="btn btn-primary close-modal-add-client"
                        wire:click="guardarCliente">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="BorrarModal" tabindex="-1" aria-labelledby="BorrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BorrarModalLabel">Eliminar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>¿Estas seguro que deseas elimiar este cliente?</h4>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary close-modal-add-client-button2 mx-2"
                            data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="button" class="btn btn-danger close-modal-add-client2"
                            wire:click="BorrarCliente">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const bodyElement = document.body;

            document.addEventListener('DOMContentLoaded', function() {
                const closeModalButtons = document.querySelectorAll('.close-modal-add-client');
                closeModalButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const closeButton = document.querySelector('.close-modal-add-client-button');
                        closeButton.click();
                    });
                });
                const closeModalButtons2 = document.querySelectorAll('.close-modal-add-client2');
                closeModalButtons2.forEach(button => {
                    button.addEventListener('click', function() {
                        const closeButton = document.querySelector('.close-modal-add-client-button2');
                        closeButton.click();
                    });
                });
            });
        </script>
    @endpush

</div>
