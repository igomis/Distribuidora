@extends('layouts.main');
@section('body')
    <div>
        @foreach (\App\Category::getAll() as $cat)
            <p><a href='products.php?category={{$cat->id}}'>{{$cat->name}}</a></p>
        @endforeach
    </div>
@endsection