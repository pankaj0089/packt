<div class="container mx-auto max-w-auto px-8 py-4">
    <section class="max-w-auto p-6 bg-white rounded-md shadow-md dark:bg-gray-800 border-blue-600 border-t-2">
        <x-form-header heading="{{ ($edit) ? 'Modify' : 'Add' }} {{ $heading }}" path="{{ $action }}" />
        <form wire:submit.prevent="saveData">
           <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
             <div class="flex gap-x-2">
               <div class="w-1/4">
                 <x-authors-dropdown />
               </div>
               <div class="w-full">
                 <x-input-field wire:model="title" label="Title" name="title" id="title" maxlength="150" class="sm:w-full" value="" isRequired=true />
               </div>
             </div>

           </div>
           <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">
            <div>
              <livewire:trix :value="$body">
            </div>
          </div>
          <x-submit-button />
        </form>
    </section>
    @if (session()->has('message'))
           <div class="alert alert-success">
               {{ session('message') }}
           </div>
       @endif
</div>
