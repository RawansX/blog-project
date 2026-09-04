<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-2xl text-navy">
            مقالاتي
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @forelse ($posts as $post)
                    <div class="border-b py-4 flex justify-between items-start">
                        <div>
                            <h3 class="font-serif text-lg font-semibold">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-muted">{{ Str::limit($post->content, 100) }}</p>
                        </div>

                        <div class="flex gap-2 shrink-0">
                            <a href="{{ route('posts.edit', $post) }}" class="text-sky text-sm">تعديل</a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}"
                                  onsubmit="return confirm(' حذف ');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm">حذف</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">لايوجد مقالات .</p>
                @endforelse

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>