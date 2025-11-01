@extends('layouts.app')

@section('title', 'Posts List - Validation Practice')

@section('content')
<div class="card">
    <h1>All Posts</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary" style="margin: 20px 0;">+ Create New Post</a>
    @else
        <div class="alert alert-danger" style="margin: 20px 0;">
            Please log in to create posts. (Authentication required)
        </div>
    @endauth

    @if($posts->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <strong>{{ $post->title }}</strong>
                            <br>
                            <small style="color: #666;">{{ Str::limit($post->excerpt ?? $post->content, 60) }}</small>
                        </td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @if($post->status === 'published')
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-warning">Draft</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $posts->links() }}
        </div>
    @else
        <div style="padding: 40px; text-align: center; background: #f8f9fa; border-radius: 4px; margin-top: 20px;">
            <h3 style="color: #666; margin-bottom: 10px;">No posts yet!</h3>
            <p style="color: #999;">Be the first to create a post.</p>
        </div>
    @endif

    <div class="info-box" style="margin-top: 30px;">
        <h3>About Post Validation</h3>
        <p style="margin: 10px 0; line-height: 1.6; color: #555;">
            The post creation form demonstrates advanced Laravel validation features including:
        </p>
        <ul style="color: #666;">
            <li><strong>Relationship Validation:</strong> Category and tags must exist in database</li>
            <li><strong>Conditional Validation:</strong> Publish date required only if status is "published"</li>
            <li><strong>Array Validation:</strong> Multiple tags can be selected (max 5)</li>
            <li><strong>Authorization:</strong> Only authenticated users can create posts</li>
            <li><strong>File Upload:</strong> Featured image with size and type validation</li>
        </ul>
    </div>
</div>
@endsection
