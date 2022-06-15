@extends('news::layouts.master')

@section('content')
    <h1>Hello World Create News</h1>

    <p>
        This view is loaded from module: {!! config('news.name') !!}
    </p>
    <x-alert type="success" message="this is news component" class="mt-4" />
@endsection
