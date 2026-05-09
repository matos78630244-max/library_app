@extends('layouts.app')
@section('title', 'Categorías')
@section('content')
    <h1 class="text-3xl font-bold text-slate-900 mb-6">Categorías</h1>
    @if($categories->isEmpty())
        <p class="text-slate-500 italic">No hay categorías registradas.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                    class="block rounded shadow-sm hover:shadow-md transition overflow-hidden">
                    <div class="p-6 flex flex-col items-center justify-center text-center"
                        style="background-color: {{ $category->color ?? '#94a3b8' }}">
                        <h2 class="text-xl font-bold text-white drop-shadow">
                            {{ $category->name }}
                        </h2>
                        <span class="mt-2 bg-white/30 text-white text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $category->books_count }} {{ Str::plural('libro', $category->books_count) }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-6">{{ $categories->links() }}</div>
    @endif
@endsection