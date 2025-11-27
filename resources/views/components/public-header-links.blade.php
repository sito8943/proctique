@props(['layout' => 'desktop'])


@if ($layout === 'desktop')
    <ul class="flex gap-2 items-center justify-end">
        <li>
            <x-public-nav-link :href="route('home')" :active="request()->routeIs('home')"
                layout="desktop">Home</x-public-nav-link>
        </li>
        <li>
            <x-public-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')"
                layout="desktop">Discover Projects</x-public-nav-link>
        </li>
        @if (auth()->user() != null)
            <li>
                <a href="{{ route('admin.profile.edit') }}">
                    <x-media-image :model="auth()->user()" class="w-8 h-8 bg-gray-50 rounded-full object-cover"
                        :alt="auth()->user()->name" />
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('login') }}"
                    class="transition rounded-3xl px-4 py-1 text-white hover:text-red-400 hover:bg-white">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                    class="transition rounded-3xl px-4 py-1 hover:text-white hover:bg-red-600 text-red-400 bg-white">Register</a>
            </li>
        @endif
    </ul>
@elseif ($layout === 'mobile')
    <ul class="px-3 py-2">
        <li>
            <x-public-nav-link :href="route('home')" :active="request()->routeIs('home')"
                layout="mobile">Home</x-public-nav-link>
        </li>
        <li>
            <x-public-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')"
                layout="mobile">Projects</x-public-nav-link>
        </li>
        @if (auth()->user() != null)
            <li class="mt-1">
                <a href="{{ route('admin.profile.edit') }}"
                    class="flex items-center gap-2 w-full rounded-3xl px-4 py-2 text-red-500 hover:bg-red-50">
                    <x-media-image :model="auth()->user()" class="w-8 h-8 bg-gray-50 rounded-full object-cover"
                        :alt="auth()->user()->name" />
                    <span>Profile</span>
                </a>
            </li>
        @else
            <li class="mt-1 flex gap-2">
                <a href="{{ route('login') }}"
                    class="flex-1 text-center rounded-3xl px-4 py-2 text-red-500 border border-red-200 hover:bg-red-50">Login</a>
                <a href="{{ route('register') }}"
                    class="flex-1 text-center rounded-3xl px-4 py-2 text-white bg-red-500 hover:bg-red-600">Register</a>
            </li>
        @endif
    </ul>
@endif