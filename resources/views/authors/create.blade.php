{{-- resources/views/authors/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Registrar autor')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-800">Registrar autor</h1>
        <a href="{{ route('authors.index') }}"
            class="text-sm text-slate-600 hover:text-slate-900">← Volver al listado</a>
    </div>

    @include('authors._form', ['author' => null])
</div>
@endsection