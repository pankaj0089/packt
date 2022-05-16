
  <div class="container mx-auto max-w-7xl px-6 py-4" x-data="{ showModalForm: false }">
    <h2 class="text-2xl">{{ $heading }}</h2>
    <div class="bg-white p-6 rounded-md mt-4 border-t-2 border-blue-600">
        <div class="grid grid-cols-2 mb-4">
          <div class="flex gap-4">
            <div class="flex-none rounded-md mr-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <input wire:model.debounce.500ms="q" type="search" placeholder="Search" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none">
                </div>
            </div>
          </div>
            <x-add-button />
        </div>


        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border-2 py-2 w-12 text-gray-500">#</th>
                    <th class="border-2 text-left px-4 py-2 cursor-pointer text-gray-500" wire:click="sortBy('title')">
                        <div class="flex items-center">
                            <button class="font-bold">Title</button>
                            <x-sort-icon sortField="title" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="border-2 py-2 w-1/5 text-gray-500">Author</th>
                    <th class="border-2 w-1/12 text-gray-500">GoRest API</th>
                    <th class="border-2 w-1/6 text-gray-500">Last updated</th>
                    <th class="border-2 w-24 text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td class="border py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border py-2 px-4">{{ $item->title }}</td>
                    <td class="border py-2 px-4">{{ ($item->author) ? $item->author->name : '' }}</td>
                    <td class="border py-2 px-4">{{ $item->rest_post_id }}</td>
                    <td class="border py-2 px-4">{{ $item->updated_at }}</td>
                    <td class="border py-2 text-center">
                        <a href="{{ route($action.'.edit', $item->id) }}" title="Edit"><button class="p-2 font-semibold text-black transition-colors duration-200 transform rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 hover:text-white focus:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        </a>
                        <button @click="showModalForm = true" title="Delete" class="p-2 text-black transition-colors duration-200 transform rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600 hover:text-white focus:text-white"
                        wire:click="deleteRecord({{ $item->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
                </thead>
        </table>
        <div class="mt-4">
            {{ $data->links() }}
        </div>
    </div>

    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto mt-50" x-show="showModalForm" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.outside="showModalForm = false" style="display:none">
        <div class="shadow-lg rounded-2xl p-4 bg-white dark:bg-gray-800 w-64 m-auto mt-8">
            <div class="w-full h-full text-center">
                <div class="flex h-full flex-col justify-between">
                    <svg width="40" height="40" class="mt-4 w-12 h-12 m-auto text-indigo-500" fill="currentColor" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z">
                        </path>
                    </svg>
                    <p class="text-gray-800 dark:text-gray-200 text-xl font-bold mt-4">
                        Remove post
                    </p>
                    <p class="text-gray-600 dark:text-gray-400 text-xs py-2 px-6">
                        Are you sure you want to delete this post ?
                    </p>
                    <div class="flex items-center justify-between gap-4 w-full mt-8">
                        <button type="button" class="py-2 px-4  bg-red-600 hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg " wire:click.prevent="delete()">
                            Delete
                        </button>
                        <button @click="showModalForm = false" type="button" class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg " >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
