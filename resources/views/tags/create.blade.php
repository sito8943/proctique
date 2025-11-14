<x-site-layout title="Create a new tag">
    <form method="POST" action="/tags" class="flex gap-4 flex-col">
        @csrf
        <div class="flex gap-4 items-center justify-start">
            <label for="name">Name</label>
            <input class="border-gray-200 border-2 rounded-3xl px-4 py-1" id="name" name="name" type="text"
                placeholder="Ex: Coding tool" />
        </div>
        <div class="flex gap-4 items-center justify-start">
            <label for="color">Color</label>
            <input class="border-gray-200 border-2 rounded-3xl px-4 py-1" id="color" name="color" type="color"
                placeholder="Ex: #ddffdd" />
        </div>
        <div>
            <button type="submit" class="bg-red-400 hover:bg-red-300 transition rounded-3xl px-4 py-2 text-white">
                Create
            </button>
        </div>
    </form>
</x-site-layout>