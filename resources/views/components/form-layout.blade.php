<form method="POST" action="{{ $action }}" class="flex gap-4 flex-col w-full {{ $class }}" enctype="{{ $enctype }}">
    @csrf
    @method($method)
    <div class="{{ $contentClass }}">
        {{ $slot }}
    </div>
    <div>
        <button type="submit" class="bg-red-400 hover:bg-red-300 transition rounded-3xl px-4 py-2 text-white">
            @if ($method == 'POST')
                Create
            @else
                Update
            @endif
        </button>
    </div>
</form>