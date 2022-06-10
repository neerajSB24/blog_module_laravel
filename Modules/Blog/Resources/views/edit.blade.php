@extends('blog::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        Create Module: {!! config('blog.name') !!}
    </p>
@endsection
