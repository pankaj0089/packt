<div class="container mx-auto max-w-auto px-8 py-4">
    <section class="max-w-auto p-6 bg-white rounded-md shadow-md dark:bg-gray-800 border-blue-600 border-t-2">
        <x-form-header heading="{{ ($edit) ? 'Modify' : 'Add' }} {{ $heading }}" path="{{ $action }}" />
        <form wire:submit.prevent="saveData">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
             <div>
               <x-input-field tabindex="1" wire:model="name" label="Name" name="name" id="name" maxlength="100" class="sm:w-full" value="" isRequired=true />
             </div>
             <div>
               <x-input-field tabindex="2" wire:model="email" label="Email" name="email" id="email" maxlength="255" class="sm:w-full" value="" isRequired=true />
             </div>

             <div>
               <x-textarea-field tabindex="3" wire:model="address_line1" label="Address Line 1" name="address_line1" id="address_line1" maxlength="255" class="sm:w-full" value="" isRequired=true />
             </div>
             <div>
               <x-input-field tabindex="4" wire:model="address_line2" label="Address Line 2" name="address_line2" id="address_line2" maxlength="255" class="sm:w-full" value="" isRequired=false />
             </div>

             <div class="flex gap-x-2">
               <div class="w-2/3">
                 <x-input-field tabindex="5" wire:model="city" label="City" name="city" id="city" maxlength="50" class="sm:w-full" value="" isRequired=true />
               </div>
               <div class="w-1/2">
                  <x-countries-dropdown tabindex="6" />
               </div>
             </div>
             <div class="flex gap-x-2">
               <div class="w-1/3">
                  <x-gender-dropdown tabindex="7" />
               </div>
               <div class="w-1/3">
                 <x-status-select tabindex="8" />
               </div>
             </div>
           </div>
          <x-submit-button tabindex="9" />
        </form>
    </section>
    @if (session()->has('message'))
           <div class="alert alert-success">
               {{ session('message') }}
           </div>
       @endif
</div>
