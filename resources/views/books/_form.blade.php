{{-- resources/views/books/_form.blade.php --}}
@php
    $isEdit = isset($book) && $book && $book->exists;
    $action = $isEdit ? route('books.update', $book) : route('books.store');
    $submit = $isEdit ? 'Actualizar Libro' : 'Guardar Libro';
    $selectedAuthorIds = $isEdit ? $book->authors->pluck('id')->toArray() : [];
@endphp

@if ($errors->any())
    <div class="mb-6 rounded-md border border-red-300 bg-red-50 p-4">
        <p class="font-semibold text-red-800 mb-2">
            Hay {{ $errors->count() }} error(es) en el formulario:
        </p>
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
    @if ($isEdit)
        @method('PUT')
    @endif

    {{-- Título --}}
    <div>
        <label for="title" class="block text-sm font-medium text-slate-700">
            Título <span class="text-red-600">*</span>
        </label>
        <input type="text" name="title" id="title" required
            value="{{ old('title', $book?->title) }}"
            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                   focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    {{-- ISBN y editorial --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="isbn" class="block text-sm font-medium text-slate-700">
                ISBN @if (!$isEdit)<span class="text-red-600">*</span>@endif
            </label>
            @if ($isEdit)
                <input type="text" id="isbn" readonly value="{{ $book->isbn }}"
                    class="mt-1 block w-full rounded-md border-slate-300
                           bg-slate-100 text-slate-500 cursor-not-allowed">
                <p class="mt-1 text-xs text-amber-700">El ISBN no es editable.</p>
            @else
                <input type="text" name="isbn" id="isbn" required
                    placeholder="978-..." value="{{ old('isbn') }}"
                    class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                           focus:border-indigo-500 focus:ring-indigo-500">
            @endif
        </div>
        <div>
            <label for="publisher" class="block text-sm font-medium text-slate-700">
                Editorial
            </label>
            <input type="text" name="publisher" id="publisher"
                value="{{ old('publisher', $book?->publisher) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
    </div>

    {{-- Año, páginas, idioma --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label for="publish_year" class="block text-sm font-medium text-slate-700">
                Año
            </label>
            <input type="number" name="publish_year" id="publish_year"
                min="1000" max="{{ date('Y') }}"
                value="{{ old('publish_year', $book?->publish_year) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="pages" class="block text-sm font-medium text-slate-700">
                Páginas
            </label>
            <input type="number" name="pages" id="pages" min="1"
                value="{{ old('pages', $book?->pages) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="language" class="block text-sm font-medium text-slate-700">
                Idioma
            </label>
            <select name="language" id="language"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
                @php $idiomas = ['Español','Inglés','Portugués','Francés','Alemán','Otro']; @endphp
                @foreach ($idiomas as $idioma)
                    <option value="{{ $idioma }}"
                        {{ old('language', $book?->language) === $idioma ? 'selected' : '' }}>
                        {{ $idioma }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Descripción --}}
    <div>
        <label for="description" class="block text-sm font-medium text-slate-700">
            Descripción
        </label>
        <textarea name="description" id="description" rows="4"
            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                   focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $book?->description) }}</textarea>
    </div>

    {{-- Portada y copias totales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="cover_url" class="block text-sm font-medium text-slate-700">
                URL de portada
            </label>
            <input type="url" name="cover_url" id="cover_url"
                value="{{ old('cover_url', $book?->cover_url) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
        <div>
            <label for="total_copies" class="block text-sm font-medium text-slate-700">
                Copias totales <span class="text-red-600">*</span>
            </label>
            <input type="number" name="total_copies" id="total_copies"
                min="1" required
                value="{{ old('total_copies', $book?->total_copies ?? 1) }}"
                class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                       focus:border-indigo-500 focus:ring-indigo-500">
        </div>
    </div>

    {{-- Categoría --}}
    <div>
        <label for="category_id" class="block text-sm font-medium text-slate-700">
            Categoría <span class="text-red-600">*</span>
        </label>
        <select name="category_id" id="category_id" required
            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm
                   focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">-- Seleccionar categoría --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $book?->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Autores --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">
            Autores <span class="text-red-600">*</span>
        </label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 max-h-64 overflow-y-auto
                    border border-slate-200 rounded-md p-3 bg-slate-50">
            @foreach ($authors as $author)
                <label class="flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                        {{ in_array($author->id, old('authors', $selectedAuthorIds)) ? 'checked' : '' }}
                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    {{ $author->first_name }} {{ $author->last_name }}
                </label>
            @endforeach
        </div>
    </div>

    {{-- Botones --}}
    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
        <a href="{{ $isEdit ? route('books.show', $book) : route('books.index') }}"
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