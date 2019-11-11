@extends('layouts.main');
@section('body')
    <div>
        <table>
            <form action = '' method = 'POST'>
                <tr><td>Categoria:</td><td>
                        <select name="idCategory">
                            @foreach (\App\Category::getAll() as $cat)
                                <option value='{{$cat->id}}' @if ($product->idCategory == $cat->id) selected @endif >{{$cat->name}}</option>";
                            @endforeach
                        </select>
                    </td></tr>
                @if (isset($product->id))
                    <input name = 'id' type='hidden' value="{{$product->id}}" >
                @endif
                <tr><td>Nom:</td><td><input name = 'name' type='text' value="{{$product->name}}" ></td></tr>
                <tr><td>Descripció:</td><td><input name = 'description' type='text' value="{{$product->description}}"></td></tr>
                <tr><td>Stock:</td><td><input name = 'stock' type='text' value="{{$product->stock}}"></td></tr>
                <tr><td>Preu:</td><td><input name = 'price' type='text'value="{{$product->price}}" ></td></tr>
                <tr><td><input name='submit' type = 'submit' value='Validar'></td></tr>
            </form>
        </table>
    </div>
@endsection