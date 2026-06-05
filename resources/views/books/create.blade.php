{{-- resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Registrar libro')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Registrar libro</h1>
        <a href="{{ route('books.index') }}"
            class="text-sm text-slate-600 hover:text-slate-900">← Volver al catálogo</a>
    </div>

    @include('books._form', [
        'book'       => null,
        'categories' => $categories,
        'authors'    => $authors,
    ])
</div>
@endsection