<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-700">{{ $post->content }}</p>
                <p class="text-sm text-gray-400 mt-4">بواسطة {{ $post->user->name }}</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4">التعليقات</h3>

                @foreach ($post->comments as $comment)
                    <div class="border-b py-3 flex justify-between items-start">
                        <div>
                            <p class="font-medium">{{ $comment->user->name }}</p>
                            <p class="text-gray-600">{{ $comment->content }}</p>
                        </div>

                        @if ($comment->user_id === auth()->id())
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm">حذف</button>
                            </form>
                        @endif
                    </div>
                @endforeach

                <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" placeholder="أضيفي تعليق..."
                              class="border-gray-300 rounded-md shadow-sm w-full"></textarea>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md mt-2">
                        إرسال
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>