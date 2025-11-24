<x-site-layout title="Proctique">
    <section id="hero">

    </section id='trending-projects'>

    <section>
        <h2 class="text-6xl font-semibold my-10">
            Trending Projects
        </h2>
    </section>

    <section id="recent-projects">
        <h2 class="text-6xl font-semibold my-10">
            Recent projects
        </h2>

        <div class="flex gap-10 border border-slate-100 shadow-sm p-4 rounded-lg">
            <x-media-image :model="$mostRecentProject" conversion="website"
                class="aspect-video w-full object-cover rounded-lg" />
            <div class="flex flex-col gap-4">
                <h3 class="font-bold text-2xl sm:text-3xl lg:text-4xl">
                    {{ $mostRecentProject->name }}
                </h3>
                <x-author :date="$mostRecentProject->published_at" :author="$mostRecentProject->author"></x-author>
                <x-tags :tags="$mostRecentProject->tags"></x-tags>
                <p class="text-sm sm:text-base">
                    {{ $mostRecentProject->leading }}
                </p>
                <a>
                    Read
                </a>
            </div>
        </div>

        <div class="mt-10">
            <x-project-grid :projects="$recentProjects" />
        </div>
    </section>

    <section id="register-cta">
        <h2 class="text-6xl font-semibold my-10">
            What are you waiting for?
        </h2>
    </section>
</x-site-layout>