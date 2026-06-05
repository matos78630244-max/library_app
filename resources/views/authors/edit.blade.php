{{-- resources/views/authors/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Editar autor')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Editar autor</h1>
        <a href="{{ route('authors.show', $author) }}"
            class="text-sm text-slate-600 hover:text-slate-900">← Volver al autor</a>
    </div>

    @include('authors._form', ['author' => $author])
</div>
@endsection
