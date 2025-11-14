<x-site-layout title="{{ $project->name }}">
    <div class="flex flex-col gap-4 items-start justify-start">
        <p class="italic">
            Publish by
            <a href="/authors/{{ $project->author->id }}" class="transition text-red-400 hover:text-red-300">
                {{ $project->author->name }}
            </a>
        </p>
        <x-tags-layout :tags="$project->tags"></x-tags-layout>
        <p>
            {{ $project->description }}
        </p>
    </div>
</x-site-layout>