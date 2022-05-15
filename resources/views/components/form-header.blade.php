<div class="grid grid-cols-2 gap-6 mb-8">
    <div>
        <h2 class=" text-xl font-semibold text-gray-700 capitalize dark:text-white">{{ $heading }}</h2>
    </div>
    <div>
        <a href="{{ route($path.'.listing')}}">
            <button class="float-right px-4 py-1 text-white text-sm transition-colors duration-200 transform bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:bg-yellow-600">Back</button>
        </a>
    </div>
</div>
