@extends('layouts.app')
 
@section('title', 'Catálogo')
 
@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900">Catálogo de Libros</h1>
        <a href="{{ route('books.create') }}"
           class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded
                  text-sm font-medium">
            + Registrar Libro
        </a>
    </div>
 
    @if($books->isEmpty())
        <p class="text-slate-500 italic">Aún no hay libros registrados.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($books as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
 
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    @endif
@endsection
