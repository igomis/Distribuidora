@extends('layouts.main');
@section('body')
    <div id="productos">
        <table class="table table-striped table-hover">
            <tr><th>Nombre</th><th>Descripción</th><th>Stock</th><th>Comprar</th></tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }} </td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <form method = 'POST'>
                        <input type="hidden" name="id" value="{{ $product->id }}" />
                        <input type = 'submit' name='delete' value="Esborrar" />
                        <input type = 'submit' name='update' value="Modificar"/>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <a href="addProduct.php" >Agefir Producte</a>
    </div>
@endsection