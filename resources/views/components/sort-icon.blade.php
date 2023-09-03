@props(['sortBy', 'sortAsc', 'sortField'])
@if ($sortBy == $sortField)
    @if ($sortAsc)
        <x-icon class="w-4 h-4" name="arrow-small-up" />
    @endif
    @if (!$sortAsc)
        <x-icon class="w-4 h-4" name="arrow-small-down" />
    @endif
@endif
