<x-app-layout title="Create a new tag">
    <x-form method="POST" action="/admin/tags" contentClass="flex flex-col gap-4">
        <x-text-input required="true" name="name" id="name" label="Name" :value="old('name', '')"
            placeholder="Ex: Coding tool"></x-text-input>
        <x-color-input name="color" id="color" :value="old('color', '#ccffdd')" />
    </x-form>
</x-app-layout>