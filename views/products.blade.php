@extends('layouts.main');
@section('body')
    <div id="cesta" style="text-align:center">
        @include('order')
    </div>
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
                        <input type="hidden" name="cod" value="{{ $product->id }}" />
                        <input name = 'unidades' type='number' min = '1' value = '1' />
                        <input type = 'submit' name='comprar' value='Comprar'>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection