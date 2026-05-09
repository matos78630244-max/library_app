@props(['type'])
@php
    $styles = match($type) {
        'premium'  => 'bg-amber-200 text-amber-900',
        'student'  => 'bg-blue-100 text-blue-800',
        default    => 'bg-slate-200 text-slate-800',
    };

    $labels = match($type) {
        'premium'  => '★ Premium',
        'student'  => 'Estudiante',
        default    => 'Estándar',
    };
@endphp
<span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold {{ $styles }}">
    {{ $labels }}
</span>