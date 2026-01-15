<x-app-layout title='All Projects' action="/admin/projects/create" button="New Project">

    <div class="w-full pl-4 top-32 sticky bg-gray-100 z-10">
        {{ $projects->links() }}
    </div>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <li class="h-full">
                <div class="transition rounded-lg h-full p-4 flex flex-col items-start justify-between gap-2
                    {{ $project->published_at ? 'bg-gray-200' : 'bg-amber-50 border-2 border-dashed border-amber-300' }}">
                    <x-admin.actions class="w-full">
                        <a href="{{ route('admin.project.publish', $project->id) }}" class="hover:text-blue-600"
                            title="@if ($project->published_at) Unpublish @else Publish @endif">
                            @if ($project->published_at)
                                <x-fas-eye-slash class="w-4 h-4" />
                            @else
                                <x-fas-eye class="w-4 h-4" />
                            @endif
                        </a>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="hover:text-blue-600" title="Edit">
                            <x-fas-edit class="w-4 h-4" />
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}" class="flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-400 cursor-pointer" title="Delete">
                                <x-fas-trash class="w-4 h-4" />
                            </button>
                        </form>
                    </x-admin.actions>
                    <div class="flex flex-col items-start justify-start h-full w-full">
                        <div class="relative w-full my-2">
                            <x-media-image :model="$project" conversion="website"
                                class="aspect-video w-full object-cover rounded-lg" />
                            @if (!$project->published_at)
                                <span class="absolute top-2 left-2 text-xs px-2 py-1 rounded bg-amber-500 text-white shadow">Unpublished</span>
                            @endif
                        </div>
                        <h3 class="font-bold text-lg">{{ $project->name }}</h3>
                        <p class="text-sm text-gray-600">by {{ $project->author->name }}</p>

                        <div class="flex flex-col gap-1 mt-2">
                            <h4>
                                Tags
                            </h4>
                            <x-tags :tags="$project->tags" admin="{{ auth()->user()->is_admin }}" />
                        </div>
                    </div>

                </div>
            </li>
        @endforeach
    </ul>
</x-app-layout>
