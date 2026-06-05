{{-- resources/views/authors/_form.blade.php --}}
@php
    $isEdit = isset($author) && $author && $author->exists;
    $action = $isEdit ? route('authors.update', $author) : route('authors.store');
    $submit = $isEdit ? 'Actualizar Autor' : 'Guardar Autor';
    $cancelUrl = $isEdit ? route('authors.show', $author) : route('authors.index');
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-md border border-red-300 bg-red-50 p-4">
        <ul class="list-disc list-inside text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}"
    class="bg-white shadow rounded-lg p-6 space-y-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="first_name" class="block text-sm font-medium text-slate-700">
                Nombre <span class="text-red-600">*</span>
            </label>
            <input type="text" name="first_name" id="first_name" required
                value="{{ old('first_name', $author?->first_name) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="last_name" class="block text-sm font-medium text-slate-700">
                Apellido <span class="text-red-600">*</span>
            </label>
            <input type="text" name="last_name" id="last_name" required
                value="{{ old('last_name', $author?->last_name) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nationality" class="block text-sm font-medium text-slate-700">
                Nacionalidad
            </label>
            <input type="text" name="nationality" id="nationality"
                value="{{ old('nationality', $author?->nationality) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="birth_date" class="block text-sm font-medium text-slate-700">
                Fecha de nacimiento
            </label>
            <input type="date" name="birth_date" id="birth_date"
                max="{{ date('Y-m-d') }}"
                value="{{ old('birth_date', $isEdit ? optional($author->birth_date)->format('Y-m-d') : '') }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
    </div>

    <div>
        <label for="biography" class="block text-sm font-medium text-slate-700">
            Biografía
        </label>
        <textarea name="biography" id="biography" rows="5"
            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                   focus:border-indigo-500 focus:ring-indigo-500">{{ old('biography', $author?->biography) }}</textarea>
    </div>

    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
        <a href="{{ $cancelUrl }}"
            class="px-4 py-2 text-sm font-medium text-slate-700 bg-white
                   border border-slate-300 rounded-md hover:bg-slate-50">
            Cancelar
        </a>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-white
                   bg-indigo-600 border border-transparent rounded-md
                   hover:bg-indigo-700">
            {{ $submit }}
        </button>
    </div>
</form>
