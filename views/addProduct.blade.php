@extends('layouts.main');
@section('body')
    <div>
        <table>
            <form action = '' method = 'POST'>
                <tr><td>Categoria:</td><td>
                        <select name="category">
                            @foreach (loadCategories() as $cat)
                                <option value='{{$cat->id}}'>{{$cat->name}}</option>";
                            @endforeach
                        </select>
                    </td></tr>
                <tr><td>Nom:</td><td><input name = 'name' type='text' ></td></tr>
                <tr><td>Descripció:</td><td><input name = 'description' type='text' ></td></tr>
                <tr><td>Stock:</td><td><input name = 'stock' type='text' ></td></tr>
                <tr><td>Preu:</td><td><input name = 'price' type='text' ></td></tr>
                <tr><td><input name='submit' type = 'submit' value='Afegir'></td></tr>
            </form>
        </table>
    </div>
@endsection