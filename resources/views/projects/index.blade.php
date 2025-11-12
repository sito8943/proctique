<x-site-layout title='Projects'>
    <ul class="grid grid-cols-3 grid-rows-1 gap-4">
        @foreach ($projects as $project)
            <li class="h-full">
                <div class="bg-gray-200 rounded-lg h-full p-4 flex flex-col gap-2">
                    <h2 class="font-bold text-xl">
                        {{ $project->name }}
                    </h2>
                    <p>
                        {{ $project->description }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</x-site-layout>