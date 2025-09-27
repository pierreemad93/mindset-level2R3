<x-admin-layout title="Blogs">
    <x-slot name="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Blogs</h5>
                    <a class="btn btn-primary btn-sm" href="{{ route('posts.create') }}">
                        <i class="bx bx-plus"></i> Add Post
                    </a>
                </div>

                <div class="row mx-2">
                    @forelse ($posts as $post)
                        <div class="col-md-6 col-xl-4">
                            <div class="card mb-3">
                                <img class="card-img-top" src="{{ asset('admin/assets/img/elements/18.jpg') }}"
                                    alt="Card image cap">

                                <div class="card-body">
                                    {{-- Post Info --}}
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->description }}</p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Last updated at {{ $post->created_at->diffForHumans() }}
                                        </small>
                                    </p>

                                    {{-- Comments Section --}}
                                    <div class="mt-3">
                                        <h6>Comments ({{ $post->comments->count() }})</h6>
                                        <ul class="list-group list-group-flush">
                                            @forelse ($post->comments as $comment)
                                                <li class="list-group-item">
                                                    <strong>{{ $comment->user->name }}:</strong>
                                                    {{ $comment->description }}
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </li>
                                            @empty
                                                <li class="list-group-item text-muted">No comments yet.</li>
                                            @endforelse
                                        </ul>
                                    </div>

                                    {{-- Add Comment Form --}}
                                    <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                                        <div class="mb-2">
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2"
                                                placeholder="Write a comment...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-secondary">
                                            Add Comment
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Doesn't have Posts</p>
                    @endforelse
                </div>
            </div>
        </div>
    </x-slot>
</x-admin-layout>
