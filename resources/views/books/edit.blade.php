{{-- resources/views/books/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar libro')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Editar libro</h1>
        <a href="{{ route('books.show', $book) }}"
            class="text-sm text-slate-600 hover:text-slate-900">← Volver al libro</a>
    </div>

    @include('books._form', [
        'book'       => $book,
        'categories' => $categories,
        'authors'    => $authors,
    ])
</div>
@endsection