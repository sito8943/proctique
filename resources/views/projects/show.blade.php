<x-site-layout title="Project details" :showSidebar="false">
    <div class="flex flex-col gap-10 items-start justify-start">
        <img src="{{ $project->header_image }}" alt="{{ $project->name }}"
            class="aspect-video w-full h-80 object-cover rounded-lg">
        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">{{ $project->name }}</h3>
        <x-author-layout :author="$project->author" :date="$project->published_at"></x-author-layout>
        <x-tags-layout :tags="$project->tags"></x-tags-layout>
        <p class="text-sm sm:text-base">
            {{ $project->description }}
        </p>
    </div>
</x-site-layout>