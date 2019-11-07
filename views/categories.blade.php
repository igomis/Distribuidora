@extends('layouts.main');
@section('body')
    <div>
        @foreach ($categorias as $cat)
            <p><a href='products.php?category={{$cat->id}}'>{{$cat->name}}</a></p>
        @endforeach
    </div>
@endsection