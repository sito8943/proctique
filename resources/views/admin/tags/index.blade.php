<x-site-layout title='Project Tags'>
    <ul class="grid grid-cols-3 grid-rows-1 gap-4">
        @foreach ($tags as $tag)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex items-center justify-between gap-2">
                    <a href="/tags/{{ $tag->id }}" class="">
                        <h3 class="font-bold text-xl hover:text-red-400">
                            {{ $tag->name }}
                        </h3>
                    </a>
                    <ul class="flex gap-4 items-center justify-end">
                        <a href="/admin/tags/{{ $tag->id }}/edit" class="hover:text-red-400">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="/admin/tags/{{ $tag->id }}/destroy" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </ul>
                </div>
            </li>
        @endforeach
    </ul>
</x-site-layout>