<x-app-layout title='Project Tags' action="/admin/tags/create" button="New Tag">

    <div class="w-full pl-4 top-32 sticky bg-gray-100 z-10">
        {{ $tags->links() }}
    </div>

    <ul class="flex flex-wrap gap-4">
        @foreach ($tags as $tag)
            <li class="h-full">
                <div class="bg-gray-200 transition rounded-lg h-full p-4 flex items-center justify-between gap-2">
                    <h3 class="font-bold text-xl">
                        {{ $tag->name }}
                    </h3>
                    <x-admin.actions>
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="hover:text-blue-600">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="/admin/tags/{{ $tag->id }}" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </x-admin.actions>
                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>