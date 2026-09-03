<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('المقالات') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @foreach ($posts as $post)
    <div class="border-b py-4 flex justify-between items-start">
        <div>
            <h3 class="text-lg font-bold">
    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
</h3>
            <p class="text-gray-600">{{ Str::limit($post->content, 100) }}</p>
            <p class="text-sm text-gray-400">بواسطة {{ $post->user->name }}</p>
        </div>

        @if ($post->user_id === auth()->id())
            <div class="flex gap-2">
                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600">تعديل</a>

                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                      onsubmit="return confirm('متأكدة تبين تحذفين المقال؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">حذف</button>
                </form>
            </div>
        @endif
    </div>
@endforeach

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>