<x-site-layout title="Edit tag with Id: {{ $tag->id }}">
    <form method="POST" action="/tags/{{ $tag->id }}" class="flex gap-4 flex-col">
        @csrf
        @method('PUT')
        <div class="flex gap-4 items-center justify-start">
            <label for="name">Name</label>
            <input @class([
                'border-2 rounded-3xl px-4 py-1',
                'border-red-400' => $errors->has('name'),
                'border-gray-200' => !$errors->has('name'),
            ]) id="name" name="name" type="text"
                value="{{ old('name', $tag->name) }}" placeholder="Ex: Coding tool" />
            @error('name')
                <p class="text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-4 items-center justify-start">
            <label for="color">Color</label>
            <input class="border-gray-200 border-2 rounded-3xl px-4 py-1" id="color" name="color" type="color"
                placeholder="Ex: #ddffdd" value="{{ $tag->color }}" />
        </div>
        <div>
            <button type="submit" class="bg-red-400 hover:bg-red-300 transition rounded-3xl px-4 py-2 text-white">
                Update
            </button>
        </div>
    </form>
</x-site-layout>