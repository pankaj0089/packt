@php
$border_class = ($errors->has($name)) ? ' border-2 border-red-500' : ' border border-gray-300';
$classes = 'block w-full px-4 py-2 mt-1 text-gray-800 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none'.$border_class;
@endphp
  @if( !(isset($showLabel)) )
      <label class="block text-sm font-medium text-gray-700 capitalize" for="{{ $id }}">{{ $label }} {{ (isset($isRequired) && $isRequired === 'true') ? '*' : '' }}</label>
  @else
    @if($showLabel === 'true')
      <label class="block text-sm font-medium text-gray-700 capitalize" for="{{ $id }}">{{ $label }} {{ (isset($isRequired) && $isRequired === 'true') ? '*' : '' }}</label>
    @endif
  @endif
  <div class="relative">
    <textarea rows="1" {{ $attributes->merge(['class' => $classes]) }} placeholder="Enter {{ $label }}">{{ $value }}</textarea>
    @error($name)
    <div class="absolute inset-y-0 right-1 top-2 pr-3 items-center pointer-events-none">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
        class="text-red-500 right-2 bottom-3 mt-1 mr-2" viewBox="0 0 1792 1792">
        <path d="M1024 1375v-190q0-14-9.5-23.5t-22.5-9.5h-192q-13 0-22.5 9.5t-9.5 23.5v190q0 14 9.5 23.5t22.5 9.5h192q13 0 22.5-9.5t9.5-23.5zm-2-374l18-459q0-12-10-19-13-11-24-11h-220q-11 0-24 11-10 7-10 21l17 457q0 10 10 16.5t24 6.5h185q14 0 23.5-6.5t10.5-16.5zm-14-934l768 1408q35 63-2 126-17 29-46.5 46t-63.5 17h-1536q-34 0-63.5-17t-46.5-46q-37-63-2-126l768-1408q17-31 47-49t65-18 65 18 47 49z">
        </path>
      </svg>
    </div>
    <div class="text-red-500">
      {{ $message }}
    </div>
    @enderror
    </div>
