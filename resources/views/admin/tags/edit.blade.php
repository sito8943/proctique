<x-app-layout title='Edit tag with Id: {{ $tag->id }}'>
    <x-form-layout method="PUT" action="/tags/{{ $tag->id }}">
        <x-text-input name="name" id="name" label="Name" :value="old('name', $tag->name)"
            placeholder="Ex: Coding tool"></x-text-input>
        <div class="flex gap-4 items-center justify-start">
            <label for="color">Color</label>
            <input class="border-gray-200 border-2 rounded-3xl px-4 py-1" id="color" name="color" type="color"
                placeholder="Ex: #ddffdd" value="{{ $tag->color }}" />
        </div>
    </x-form-layout>
</x-app-layout>