<nav x-data="{ open: false }" class="bg-gradient-to-l from-navy to-sky border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24 gap-4">
            <a href="{{ route('posts.index') }}" class="font-serif text-2xl text-white font-bold tracking-wide whitespace-nowrap">
                مدونة تقنية
            </a>

            <div class="hidden sm:flex items-center gap-2 flex-1 max-w-md">
                <form method="GET" action="{{ route('posts.index') }}" class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="ابحثي عن مقال..."
                           class="w-full rounded-full border-gray-200 bg-sky-light/50 text-sm px-4 py-2 focus:border-sky focus:ring-sky">
                </form>

                <a href="{{ route('posts.index') }}" class="text-sm text-white/80 hover:text-white px-3 py-1.5 rounded-full whitespace-nowrap">
                    الكل
                </a>

                <a href="{{ route('posts.mine') }}" class="text-sm text-white/80 hover:text-white px-3 py-1.5 rounded-full whitespace-nowrap">
                    مقالاتي
                </a>
            </div>

            <div class="flex items-center gap-3 shrink-0">

                <a href="{{ route('posts.create') }}" title="كتابة مقال"
                   class="flex items-center justify-center h-9 w-9 rounded-full text-white hover:bg-white/20 transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z" />
                    </svg>
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center justify-center h-9 w-9 rounded-full bg-white text-navy text-sm font-medium">
                                {{ mb_substr(Auth::user()->name, 0, 1) }}
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">الملف الشخصي</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    تسجيل الخروج
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

            </div>
        </div>
    </div>
</nav>