@php
$border_class = ($errors->has('author_id')) ? ' border-2 border-red-500' : ' border border-gray-300';
$classes = 'mt-1 appearance-none bg-transparent py-2 pl-3 text-sm font-semibold w-full rounded-md'.$border_class;
@endphp
<label class="block text-sm font-medium text-gray-700 capitalize" for="author_id">Select Author *</label>
<select wire:model="author_id" class="{{ $classes }}" tabindex="{{ $tabindex }}"
wire:change="$emit('authorUpdated')" >
    <option value="0">Select Author</option>
    @foreach($authors as $key => $item)
      <option value="{{ $key }}">{{ $item }}</option>
    @endforeach
</select>
@error('author_id')
<div class="absolute text-red-500 mt-2">Required</div>
@enderror
