<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(request('search'))
                <p class="text-muted text-sm mb-6">
                    نتائج البحث عن: <span class="text-navy font-medium">{{ request('search') }}</span>
                </p>
            @endif

            @forelse ($posts as $post)
                <article class="border-b border-gray-100 py-8">
                    <h2 class="font-serif text-2xl font-semibold text-ink leading-snug">
                        <a href="{{ route('posts.show', $post) }}" class="hover:text-sky transition">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p class="text-muted mt-2 leading-relaxed">
                        {{ Str::limit($post->content, 140) }}
                    </p>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center gap-2 text-sm text-muted">
                            <span class="flex items-center justify-center h-6 w-6 rounded-full bg-navy text-white text-xs">
                                {{ mb_substr($post->user->name, 0, 1) }}
                            </span>
                            <span>{{ $post->user->name }}</span>
                            <span>·</span>
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                        </div>

                        @if (auth()->check() && ($post->user_id === auth()->id() || auth()->user()->hasRole('admin')))
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