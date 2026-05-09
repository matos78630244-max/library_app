@extends('layouts.app')
@section('title', $category->name)
@section('content')
    <a href="{{ route('categories.index') }}"
        class="text-sm text-slate-600 hover:text-slate-900 mb-4 inline-block">
        ← Volver a categorías
    </a>
    <div class="mb-8 p-6 rounded shadow-sm text-white"
        style="background-color: {{ $category->color ?? '#94a3b8' }}">
        <h1 class="text-3xl font-bold drop-shadow">{{ $category->name }}</h1>
        <p class="mt-1 text-white/80">{{ $category->books->count() }} {{ Str::plural('libro', $category->books->count()) }}</p>
    </div>
    @if($category->books->isEmpty())
        <p class="text-slate-500 italic">Esta categoría aún no tiene libros registrados.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($category->books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    @endif
@endsection