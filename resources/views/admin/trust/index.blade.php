@extends('admin.layouts.admin')

@section('title', 'Blog Articles')
@section('page-title', 'Halisi Trust Articles')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">All Articles</h3>
            <p class="text-sm text-gray-600">Manage your blog articles</p>
        </div>
        <a href="{{ route('admin.trust.create') }}" class="bg-[var(--color-forest-green)] text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition-colors font-medium">
            Add New Article
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                            <div class="text-sm text-gray-500">{{ $post->slug }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900">{{ $post->category }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->published_at)
                                <div class="text-sm text-gray-900">{{ $post->published_at->format('M j, Y') }}</div>
                            @else
                                <span class="text-sm text-gray-400">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.trust.edit', $post) }}" class="text-[var(--color-forest-green)] hover:text-opacity-80 mr-4">Edit</a>
                            <form action="{{ route('admin.trust.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No articles found. <a href="{{ route('admin.trust.create') }}" class="text-[var(--color-forest-green)] hover:underline">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
