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
                    <h1 class="mt-3 mb-5">Editar Usuario</h1>
                    <form wire:submit.prevent="EditarCliente">
                        <div class="form-group">
                            <label for="tipo_usuarios_id">Tipo Usuario:</label>
                            <select wire:model="tipo_usuarios_id" class="form-control" id="tipo_usuarios_id">
                                @foreach ($TipoUsuario as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_estado_usuarios_id">Estado Usuario:</label>
                            <select wire:model="tipo_estado_usuarios_id" class="form-control"
                                id="tipo_estado_usuarios_id">
                                @foreach ($TipoEstadoUsuario as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" wire:model="email" class="form-control" id="email" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" wire:model="name" class="form-control" id="name">
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
        <h1 class="mt-3 mb-5">Usuarios</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->getPerfil->descripcion }}</td>
                            <td>{{ $item->getEstado->descripcion }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->name }}</td>
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


    <div class="modal fade" id="BorrarModal" tabindex="-1" aria-labelledby="BorrarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BorrarModalLabel">Eliminar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>¿Estas seguro que deseas elimiar este usuario?</h4>
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
