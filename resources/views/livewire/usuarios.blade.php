<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Correo</th>
                <th scope="col">Nombre</th>
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
