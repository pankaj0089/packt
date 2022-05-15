<label class="block text-sm font-medium text-gray-700 capitalize" for="author_id">Select Author *</label>
<select wire:model="author_id" class="mt-1 appearance-none bg-transparent py-2 pl-3 text-sm font-semibold w-full border-gray-300 rounded-md">
    <option value="0">Select Author</option>
    @foreach($authors as $key => $item)
      <option value="{{ $key }}">{{ $item }}</option>
    @endforeach
</select>
