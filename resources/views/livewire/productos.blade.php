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
                    <th >{{ $loop->iteration }}</th>
                    <td>{{ $item->getTipoProducto->descripcion }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->precio }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->vendido }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>