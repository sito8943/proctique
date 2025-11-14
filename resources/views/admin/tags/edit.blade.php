<x-site-layout title="Edit tag with Id: {{ $tag->id }}">
    <form method="POST" action="/tags/{{ $tag->id }}" class="flex gap-4 flex-col">
        @csrf
        @method('PUT')
        <x-text-input name="name" id="name" label="Name" :value="old('name', $tag->name)"
            placeholder="Ex: Coding tool"></x-text-input>
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