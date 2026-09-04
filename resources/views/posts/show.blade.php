<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 text-sm text-sky hover:text-navy transition">
                العودة للمقالات
            </a>

            <article class="mt-6">
                @if ($post->image)
    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
         class="w-full h-64 object-cover rounded-2xl mb-6">
@endif
                

                <h1 class="font-serif text-3xl sm:text-4xl font-semibold text-ink leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-2 mt-4">
                    <span class="flex items-center justify-center h-9 w-9 rounded-full bg-navy text-white text-sm font-medium">
                        {{ mb_substr($post->user->name, 0, 1) }}
                    </span>
                    <div class="text-sm">
                        <p class="text-ink font-medium">{{ $post->user->name }}</p>
                        <p class="text-muted">{{ $post->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="text-ink leading-loose text-lg whitespace-pre-line mt-8 pt-8 border-t border-gray-100">
                    {{ $post->content }}
                </div>
            </article>

            <div class="mt-12">
                <h3 class="font-serif text-lg font-semibold text-navy mb-6">
                    التعليقات ({{ $post->comments->count() }})
                </h3>

                <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
                    @csrf
                    <textarea name="content" rows="3" placeholder="..."
                              class="w-full rounded-lg border-gray-200 focus:border-sky focus:ring-sky text-sm resize-none"></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="mt-3 bg-navy text-white text-sm font-medium px-5 py-2.5 rounded-full hover:bg-navy-dark transition">
                        نشر التعليق
                    </button>
                </form>

                @forelse ($post->comments as $comment)
                    <div class="border-b border-gray-100 py-4 flex justify-between items-start">
                        <div class="flex gap-3">
                            <span class="flex items-center justify-center h-8 w-8 rounded-full bg-sky text-white text-xs font-medium shrink-0">
                                {{ mb_substr($comment->user->name, 0, 1) }}
                            </span>
                            <div>
                                <p class="font-medium text-ink text-sm">{{ $comment->user->name }}</p>
                                <p class="text-muted text-sm mt-1">{{ $comment->content }}</p>
                            </div>
                        </div>

                        @if ($comment->user_id === auth()->id())
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-xs hover:text-red-700">حذف</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-muted text-sm text-center py-4" 💬</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>