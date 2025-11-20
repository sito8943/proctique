<x-app-layout title='Edit tag with Id: {{ $tag->id }}'>
    <x-form method="PUT" action="/admin/tags/{{ $tag->id }}" contentClass="flex flex-col gap-4">
        <x-text-input name="name" id="name" label="Name" :value="old('name', $tag->name)"
            placeholder="Ex: Coding tool"></x-text-input>

        <x-color-input name="color" id="color" :value="old('color', $tag->color)" />
    </x-form>
</x-app-layout>