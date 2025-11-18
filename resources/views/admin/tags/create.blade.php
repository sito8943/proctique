<x-site-layout title="Create a new tag">
    <x-form-layout method="POST" action="/tags">
        <x-text-input name="name" id="name" label="Name" :value="old('name', '')"
            placeholder="Ex: Coding tool"></x-text-input>
        <div class="flex gap-4 items-center justify-start">
            <label for="color">Color</label>
            <input class="border-gray-200 border-2 rounded-3xl px-4 py-1" id="color" name="color" type="color"
                placeholder="Ex: #ddffdd" />
        </div>
    </x-form-layout>
</x-site-layout>