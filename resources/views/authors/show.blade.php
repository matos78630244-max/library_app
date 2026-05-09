@extends('layouts.app')
@section('title', $author->full_name)
@section('content')
    <a href="{{ route('authors.index') }}"
        class="text-sm text-slate-600 hover:text-slate-900 mb-4 inline-block">
        ← Volver a autores
    </a>
    <div class="bg-white shadow-sm rounded p-6 mb-8">
        <h1 class="text-3xl font-bold text-slate-900">{{ $author->full_name }}</h1>
        <p class="text-slate-600 mt-1">
            {{ $author->nationality ?? 'Nacionalidad desconocida' }}
            @if($author->birth_date)
                · Nacido el {{ $author->birth_date->format('d/m/Y') }}
            @endif
        </p>
        @if($author->biography)
            <p class="mt-4 text-slate-700 leading-relaxed">{{ $author->biography }}</p>
        @endif
    </div>
    <h2 class="text-2xl font-bold text-slate-900 mb-4">
        Libros del autor ({{ $author->books->count() }})
    </h2>
    @if($author->books->isEmpty())
        <p class="text-slate-500 italic">Este autor aún no tiene libros registrados.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($author->books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    @endif
@endsection