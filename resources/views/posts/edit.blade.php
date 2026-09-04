<x-app-layout>
    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <h1 class="font-serif text-2xl font-semibold text-ink mb-8">
                تعديل المقال
            </h1>

            <form method="POST" action="{{ route('posts.update', $post) }}" class="space-y-6">
                @csrf
                @method('PUT')

                @if (auth()->id() === $post->user_id)
                    <div>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                               placeholder="عنوان المقال"
                               class="w-full border-0 border-b border-gray-200 focus:border-navy focus:ring-0 font-serif text-2xl placeholder:text-gray-300 px-0">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea name="content" rows="12" placeholder="..."
                                  class="w-full border-0 focus:ring-0 text-ink leading-loose placeholder:text-gray-300 px-0 resize-none">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <input type="hidden" name="title" value="{{ $post->title }}">
                    <input type="hidden" name="content" value="{{ $post->content }}">

                    <div class="bg-sky-light/40 rounded-lg p-4">
                        <p class="font-serif text-xl text-ink mb-1">{{ $post->title }}</p>
                    </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-muted mb-2">التصنيف</label>
                    <select name="category_id" class="w-full border-0 border-b border-gray-200 focus:border-navy focus:ring-0 text-sm bg-transparent px-0">
                        <option value="">بدون تصنيف</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-navy text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-navy-dark transition">
                        حفظ التعديلات
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>