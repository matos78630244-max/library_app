@props(['status'])
 
@php
    $config = [
        'available'   => ['label' => 'Disponible',    'class' => 'bg-green-100 text-green-800'],
        'reserved'    => ['label' => 'Reservado',     'class' => 'bg-yellow-100 text-yellow-800'],
        'unavailable' => ['label' => 'No disponible', 'class' => 'bg-red-100 text-red-800'],
    ];
    $cfg = $config[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-slate-100 text-slate-800'];
@endphp
 
<span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $cfg['class'] }}">
    {{ $cfg['label'] }}
</span>
