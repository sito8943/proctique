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
                    class="transition rounded-3xl px-4 flex items-center h-[34px] text-white hover:text-blue-600 hover:bg-white">Login</a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                    class="transition rounded-3xl px-4 flex items-center h-[34px] hover:text-white hover:bg-blue-600 text-blue-600 bg-white">Register</a>
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
                    class="flex items-center h-[34px] gap-2 w-full rounded-3xl px-4 text-blue-600 hover:bg-blue-50">
                    <x-media-image :model="auth()->user()" class="w-8 h-8 bg-gray-50 rounded-full object-cover"
                        :alt="auth()->user()->name" />
                    <span>Profile</span>
                </a>
            </li>
        @else
            <li class="mt-1 flex gap-2">
                <a href="{{ route('login') }}"
                    class="flex-1 flex items-center justify-center h-[34px] rounded-3xl px-4 text-blue-600 border border-blue-200 hover:bg-blue-50">Login</a>
                <a href="{{ route('register') }}"
                    class="flex-1 flex items-center justify-center h-[34px] rounded-3xl px-4 text-white bg-blue-600 hover:bg-blue-700">Register</a>
            </li>
        @endif
    </ul>
@endif
