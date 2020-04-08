@extends('layouts.app')

@section('content')
    @foreach ($articles as $article)
        <h2>{{ $article->name }}</h2>
        <div>{{ $article->body }}</div>
    @endforeach
@endsection
