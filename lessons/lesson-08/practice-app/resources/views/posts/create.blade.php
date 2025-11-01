@extends('layouts.app')

@section('title', 'Create Post - Validation Practice')

@section('content')
<div class="card">
    <h1>Create New Post</h1>
    <p style="color: #666; margin: 10px 0 20px;">Advanced validation with relationships and conditional rules</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="form-group">
            <label for="title">Title *</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                class="@error('title') is-invalid @enderror"
                placeholder="Enter post title"
            >
            @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Slug --}}
        <div class="form-group">
            <label for="slug">Slug * (URL-friendly version)</label>
            <input
                type="text"
                name="slug"
                id="slug"
                value="{{ old('slug') }}"
                class="@error('slug') is-invalid @enderror"
                placeholder="my-post-slug"
            >
            @error('slug')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <small style="color: #666; font-size: 12px;">Must be unique and URL-friendly</small>
        </div>

        {{-- Category --}}
        <div class="form-group">
            <label for="category_id">Category *</label>
            <select
                name="category_id"
                id="category_id"
                class="@error('category_id') is-invalid @enderror"
            >
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Tags --}}
        <div class="form-group">
            <label>Tags (Optional, max 5)</label>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                @foreach($tags as $tag)
                    <label style="display: flex; align-items: center; font-weight: normal;">
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}
                            style="width: auto; margin-right: 8px;"
                        >
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Content --}}
        <div class="form-group">
            <label for="content">Content * (min 100 characters)</label>
            <textarea
                name="content"
                id="content"
                class="@error('content') is-invalid @enderror"
                placeholder="Write your post content here..."
            >{{ old('content') }}</textarea>
            @error('content')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <small style="color: #666; font-size: 12px;">Current length: <span id="contentLength">0</span> characters</small>
        </div>

        {{-- Excerpt --}}
        <div class="form-group">
            <label for="excerpt">Excerpt (Optional, max 500 characters)</label>
            <textarea
                name="excerpt"
                id="excerpt"
                class="@error('excerpt') is-invalid @enderror"
                placeholder="Short summary of your post..."
                style="min-height: 80px;"
            >{{ old('excerpt') }}</textarea>
            @error('excerpt')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Featured Image --}}
        <div class="form-group">
            <label for="featured_image">Featured Image (Optional)</label>
            <input
                type="file"
                name="featured_image"
                id="featured_image"
                class="@error('featured_image') is-invalid @enderror"
                accept="image/*"
            >
            @error('featured_image')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <small style="color: #666; font-size: 12px;">Max 2MB</small>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label for="status">Status *</label>
            <select
                name="status"
                id="status"
                class="@error('status') is-invalid @enderror"
            >
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Published At (conditional) --}}
        <div class="form-group" id="publishedAtGroup">
            <label for="published_at">Publish Date * (required if status is Published)</label>
            <input
                type="date"
                name="published_at"
                id="published_at"
                value="{{ old('published_at') }}"
                class="@error('published_at') is-invalid @enderror"
            >
            @error('published_at')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            <small style="color: #666; font-size: 12px;">Must be today or later</small>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <div class="info-box" style="margin-top: 30px;">
        <h3>Validation Rules Applied:</h3>
        <ul style="color: #666; font-size: 14px;">
            <li><strong>Title:</strong> Required, max 255 characters</li>
            <li><strong>Slug:</strong> Required, unique, max 255 characters</li>
            <li><strong>Content:</strong> Required, minimum 100 characters</li>
            <li><strong>Excerpt:</strong> Optional, max 500 characters</li>
            <li><strong>Category:</strong> Required, must exist in database</li>
            <li><strong>Tags:</strong> Optional array, max 5 tags, each must exist</li>
            <li><strong>Featured Image:</strong> Optional, must be image, max 2MB</li>
            <li><strong>Status:</strong> Required, must be 'draft' or 'published'</li>
            <li><strong>Published At:</strong> Required if status is 'published', must be today or later</li>
        </ul>
        <p style="margin-top: 15px; color: #1976D2; font-weight: bold;">
            💡 Try changing status to "Published" - the publish date becomes required!
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Content length counter
    const contentTextarea = document.getElementById('content');
    const lengthDisplay = document.getElementById('contentLength');

    contentTextarea.addEventListener('input', function() {
        lengthDisplay.textContent = this.value.length;
    });

    // Initial count
    lengthDisplay.textContent = contentTextarea.value.length;

    // Show/hide published_at based on status
    const statusSelect = document.getElementById('status');
    const publishedAtGroup = document.getElementById('publishedAtGroup');

    function togglePublishedAt() {
        if (statusSelect.value === 'published') {
            publishedAtGroup.style.display = 'block';
        } else {
            publishedAtGroup.style.display = 'none';
        }
    }

    statusSelect.addEventListener('change', togglePublishedAt);
    togglePublishedAt(); // Initial state
</script>
@endsection
