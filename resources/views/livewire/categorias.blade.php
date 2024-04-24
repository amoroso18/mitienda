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

                    <h1 class="mt-3 mb-5">Nuevo Categoria</h1>

                    <form wire:submit.prevent="guardarProducto">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion"></textarea>
                            @error('descripcion')
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

                    <h1 class="mt-3 mb-5">Editar Categoria</h1>

                    <form wire:submit.prevent="actualizarProducto">
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion"></textarea>
                            @error('descripcion')
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
    @else
        <h1 class="mt-3 mb-5">Categorias</h1>
        <small class="d-block text-end mt-3 mb-5">
            <button type="button" class="btn btn-dark" wire:click="NuevoListener">
                Nuevo Categoria
            </button>
        </small>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th >Descripción</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($TipoProducto as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td align="left">{{ $item->descripcion }}</td>
                            <td align="right">
                                <a class="btn btn-primary"
                                    wire:click="EditarIdListener({{ $item->id }})">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif



</div>
