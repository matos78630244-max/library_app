@extends('layouts.app')
@section('title', 'Miembros')
@section('content')
    <h1 class="text-3xl font-bold text-slate-900 mb-6">Miembros (prueba badge)</h1>
    <div class="bg-white shadow-sm rounded overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-900 text-white text-left">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Membresía</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr class="border-b border-slate-100 {{ $loop->even ? 'bg-slate-50' : 'bg-white' }}">
                        <td class="px-4 py-3 font-medium">{{ $member->user->name }}</td>
                        <td class="px-4 py-3">
                            <x-membership-badge :type="$member->membership_type" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection