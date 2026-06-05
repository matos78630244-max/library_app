@props(['category'])
 
@if($category)
    <span class="inline-block px-2 py-1 rounded text-xs font-semibold text-white"
          style="background-color: {{ $category->color ?? '#475569' }}">
        {{ $category->name }}
    </span>
@endif
