<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('إنشاء مقال جديد') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">العنوان</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="border-gray-300 rounded-md shadow-sm w-full">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">المحتوى</label>
                        <textarea name="content" rows="6"
                                  class="border-gray-300 rounded-md shadow-sm w-full">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-gray-800 text-white px-4 py-2 rounded-md">
                        نشر المقال
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>