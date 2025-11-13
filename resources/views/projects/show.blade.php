<x-site-layout title="{{ $project->name }}">
    <div class="flex flex-col gap-4 items-start justify-start">
        <p class="italic">
            Publish by
            <a href="/authors/{{ $project->author->id }}" class="transition text-red-400 hover:text-red-300">
                {{ $project->author->name }}
            </a>
        </p>
        <ul class="flex gap-4 items-center justify-start">
            @foreach ($project->tags as $tag)
                <li>
                    <a href="/projects?tag={{ $tag->id }}" class="px-4 py-2 text-xs bg-red-400 hover:bg-red-300 text-white rounded-full">
                        {{ $tag->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <p>
            {{ $project->description }}
        </p>
    </div>
</x-site-layout>