@extends('layouts.app')
@section('title', 'Registrar libro')
@section('content')
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-slate-900 mb-2">Registrar Libro</h1>
        <p class="text-slate-500 mb-6 italic">
            Formulario de previsualización — la lógica de guardado se
            implementa en la Guía 7.
        </p>
        <form class="bg-white rounded shadow-sm p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb1">Título</label>
                <input type="text" disabled placeholder="Ej. Cien años de
    soledad" class="w-full border border-slate-300 rounded px-3 py-2
    bg-slate-100
     text-slate-500">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb1">
                        ISBN
                    </label>
                    <input type="text" disabled class="w-full border border-slate-300 rounded px-3
    py-2 bg-slate-100">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb1">
                        Año de publicación
                    </label>
                    <input type="number" disabled class="w-full border border-slate-300 rounded px-3
    py-2 bg-slate-100">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb1">Categoría</label>
                <select disabled class="w-full border border-slate-300 rounded px-3 py-2
    bg-slate-100">
                    <option>Selecciona una categoría...</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb1">Autores</label>
                <select disabled multiple class="w-full border border-slate-300 rounded px-3 py-2
    bg-slate-100 h-32">
                    <option>Selecciona uno o más autores...</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb1">Descripción</label>
                <textarea disabled rows="4" class="w-full border border-slate-300 rounded px-3
    py-2 bg-slate-100">
     </textarea>
            </div>
            <button type="button" disabled class="bg-slate-400 text-white px-4 py-2 rounded cursornot-allowed">
                Guardar (deshabilitado)
            </button>
        </form>
    </div>
@endsection