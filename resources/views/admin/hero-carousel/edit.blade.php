@extends('admin.layouts.admin')

@section('title', 'Edit hero slide')
@section('page-title', 'Edit hero carousel slide')

@section('content')
    @if ($errors->any())
        <div class="max-w-2xl mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            <p class="font-semibold mb-2">Please fix the following:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.hero-carousel.update', $slide) }}" enctype="multipart/form-data" class="max-w-2xl space-y-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        @csrf
        @method('PUT')
        @include('admin.hero-carousel._form', ['slide' => $slide])
        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-6 py-2 rounded-[var(--radius-button)] bg-[var(--color-forest-green)] text-white font-medium hover:bg-opacity-90">Update slide</button>
            <a href="{{ route('admin.hero-carousel.index') }}" class="px-6 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">Cancel</a>
        </div>
    </form>
@endsection
