<x-projects-index-layout title="Discover Projects">
    <div class="w-full border-slate-100 border rounded pl-4 top-16 sticky bg-white">
        {{ $projects->appends(request()->query())->links() }}
    </div>
    @if (!empty($activeTag))
        <div class="mt-2 text-sm text-gray-700">
            Filtering by: <span class="font-medium">{{ $activeTag->name }}</span>
            <a href="{{ url('/projects') }}" class="ml-2 text-blue-600 hover:underline">Clear filter</a>
        </div>
    @endif
    <ul class="grid gap-10 mt-5">
        @forelse ($projects as $project)
            <li class="h-full">
                <article
                    class="h-full w-full flex flex-col gap-4 sm:gap-5 border border-slate-100 shadow-sm p-4 sm:p-6 lg:p-8 rounded-lg transition-shadow">
                    <a href="{{ route('projects.show', $project->slug) }}" class="flex flex-col gap-3 sm:gap-4">
                        <x-media-image :model="$project" conversion="website"
                            class="aspect-video w-full object-cover rounded-lg" />
                        <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">
                            {{ $project->name }}
                        </h3>
                    </a>
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <x-stars :for="$project" with-count />
                    </div>
                    <x-author :date="$project->published_at" :author="$project->author"></x-author>
                    <x-tags :tags="$project->tags"></x-tags>
                    <p class="text-sm sm:text-base">
                        {{ $project->leading }}
                    </p>
                </article>
            </li>
        @empty
            @if (!empty($activeTag))
                <li>
                    <div class="p-4 border border-slate-100 rounded-lg bg-gray-50 text-gray-700">
                        There are no projects in the tag
                        <span class="font-medium">{{ $activeTag->name }}</span>.
                        <a href="{{ url('/projects') }}" class="ml-1 text-blue-600 hover:underline">Clear filter</a>
                    </div>
                </li>
            @endif
        @endforelse
    </ul>
</x-projects-index-layout>
