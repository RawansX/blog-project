<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(request('search'))
                <p class="text-muted text-sm mb-6">
                    نتائج البحث عن: <span class="text-navy font-medium">{{ request('search') }}</span>
                </p>
            @endif

            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('posts.index') }}"
                   class="text-sm px-4 py-1.5 rounded-full {{ !request('category') ? 'bg-navy text-white' : 'bg-white text-muted border border-gray-200' }}">
                    الكل
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->id]) }}"
                       class="text-sm px-4 py-1.5 rounded-full {{ request('category') == $category->id ? 'bg-navy text-white' : 'bg-white text-muted border border-gray-200' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            @forelse ($posts as $post)
                <article class="flex gap-5 border-b border-gray-200 py-6">

                    @if ($post->image)
                        <a href="{{ route('posts.show', $post) }}" class="shrink-0">
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                 class="w-40 h-28 object-cover rounded-lg">
                        </a>
                    @endif

                    <div class="flex-1 min-w-0">
                        <h2 class="font-serif text-xl font-bold text-ink leading-snug">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-sky transition">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-muted mt-2 leading-relaxed text-sm">
                            {{ Str::limit($post->content, 140) }}
                        </p>

                        <div class="flex items-center justify-between mt-4">
                            <p class="text-sm text-muted">
                                بواسطة {{ $post->user->name }} — {{ $post->created_at->format('d M Y') }}
                            </p>

                            @if (auth()->check() && $post->user_id === auth()->id())
                                <div class="flex gap-3 text-sm">
                                    <a href="{{ route('posts.edit', $post) }}" class="text-sky">تعديل</a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                          onsubmit="return confirm('متأكدة تبين تحذفين المقال؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">حذف</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-muted text-center py-16">ما فيه مقالات بعد.</p>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</x-app-layout>