<x-app-layout>
    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <h1 class="font-serif text-2xl font-semibold text-ink mb-8">
                كتابة مقال جديد
            </h1>

            <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
                @csrf

                <div>
                    <input type="text" name="title" value="{{ old('title') }}"
                           placeholder="عنوان المقال"
                           class="w-full border-0 border-b border-gray-200 focus:border-navy focus:ring-0 font-serif text-2xl placeholder:text-gray-300 px-0">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <textarea name="content" rows="12" placeholder="..."
                              class="w-full border-0 focus:ring-0 text-ink leading-loose placeholder:text-gray-300 px-0 resize-none">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <button type="submit" class="bg-navy text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-navy-dark transition">
                        نشر 
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>