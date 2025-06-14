<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('files.index')" :active="request()->routeIs('files.index')">
                        Partage de fichiers
                    </x-nav-link>
                    <x-nav-link :href="route('openai.index')" :active="request()->routeIs('openai.index')">
                        OpenAI Playground
                    </x-nav-link>
                    <x-nav-link :href="route('conversations.index')" :active="request()->routeIs('conversations.*')">
                        Conversations
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown (classique, sans Alpine.js) -->
<div class="relative">
    <button onclick="document.getElementById('dropdownMenu').classList.toggle('hidden')"
        class="flex items-center px-3 py-2 rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200">
        {{ Auth::user()->name }}
    </button>
    <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg py-2 hidden z-50">
        <div class="px-4 py-2 font-semibold text-gray-900">{{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left px-4 py-2 mt-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                Déconnexion
            </button>
        </form>
        <hr class="my-2">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Profile</a>
    </div>
</div>


            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <span class="sr-only">Menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('files.index')" :active="request()->routeIs('files.index')">
                Partage de fichiers
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('openai.index')" :active="request()->routeIs('openai.index')">
                OpenAI Playground
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('conversations.index')" :active="request()->routeIs('conversations.*')">
                Conversations
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                        Déconnexion
                    </button>
                </form>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
