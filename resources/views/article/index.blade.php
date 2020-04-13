@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @if (Session::has('status'))
    	{{ Session::get('status') }}
    @endif
    @foreach ($articles as $article)
        <h2><a href="{{ route('articles.show', $article->id) }}">{{$article->name}}</a></h2>

        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="{{ route('articles.edit', $article) }}">Редактировать</a>
        <a href="{{ route('articles.destroy', $article) }}" rel="nofollow">Удалить--</a>

    @endforeach
    <br><br>
    <a href="{{ route('articles.create') }}">Добавить статью</a>
@endsection
