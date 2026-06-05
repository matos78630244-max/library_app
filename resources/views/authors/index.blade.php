@extends('layouts.app')

@section('title', 'Autores')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-slate-900">Autores</h1>
    <a href="{{ route('authors.create') }}"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600
               rounded-md hover:bg-indigo-700">
        + Nuevo Autor
    </a>
</div>

@if($authors->isEmpty())
<p class="text-slate-500 italic">Aún no hay autores registrados.</p>
@else
<div class="bg-white shadow-sm rounded overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-900 text-white text-left text-sm">
            <tr>
                <th class="px-4 py-3">Nombre completo</th>
                <th class="px-4 py-3">Nacionalidad</th>
                <th class="px-4 py-3 text-center">N° de libros</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr class="border-b border-slate-100
                                   {{ $loop->even ? 'bg-slate-50' : 'bg-white' }}">
                <td class="px-4 py-3 font-medium">{{ $author->full_name }}</td>
                <td class="px-4 py-3 text-slate-600">
                    {{ $author->nationality ?? '—' }}
                </td>
                <td class="px-4 py-3 text-center">
                    <span class="bg-slate-200 text-slate-800 px-2 py-1 rounded
                                             text-xs font-bold">
                        {{ $author->books_count }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('authors.show', $author) }}"
                        class="text-sm text-amber-700 hover:underline">Ver →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $authors->links() }}</div>
@endif
@endsection