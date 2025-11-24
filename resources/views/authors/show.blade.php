<x-project-layout title="Author details" :showSidebar="false">
    <div class="flex flex-col gap-8">
        <div class="flex items-center gap-4">
            <x-media-image :model="$author" class="w-16 h-16 rounded-full object-cover bg-gray-300" :alt="$author->name" />
            <div>
                <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
                <p class="text-sm text-gray-600">{{ $author->projects_count }} projects</p>
            </div>
        </div>

        <div class="w-full border-slate-100 border rounded pl-4 top-16 sticky bg-white">
            {{ $projects->links() }}
        </div>

        <ul class="grid gap-10">
            @foreach ($projects as $project)
                <li class="h-full">
                    <article
                        class="h-full w-full flex flex-col gap-4 sm:gap-5 border border-slate-100 shadow-sm p-4 sm:p-6 lg:p-8 rounded-lg transition-shadow">
                        <a href="/projects/{{ $project->id }}" class="flex flex-col gap-3 sm:gap-4">
                            <x-media-image :model="$project" conversion="website"
                                class="aspect-video w-full object-cover rounded-lg" />
                            <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">
                                {{ $project->name }}
                            </h3>
                        </a>
                        <x-author :date="$project->published_at" :author="$project->author" :show-label="false"></x-author>
                        <x-tags :tags="$project->tags"></x-tags>
                        <p class="text-sm sm:text-base">
                            {{ $project->leading }}
                        </p>
                    </article>
                </li>
            @endforeach
        </ul>
    </div>
</x-project-layout>

