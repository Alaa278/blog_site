@extends('layouts.app')

@section('content')
    <div class=" w-75 m-auto">
        <div class="card">
            <div class="card-header">
                <h5> {{ $post->title }} </h5>
            </div>
            <div class="card-body">

                <p class="card-title"> By {{ $post->user->name }}, Created on
                    {{ date('jS M Y', strtotime($post->updated_at)) }}.
                </p>
                <p class="card-text"> {{ $post->description }}</p>
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        @auth
            <!-- Add Comment -->
            <div class="card mt-3">
                <h5 class="card-header">Add Comment</h5>
                <div class="card-body">
                    <form method="post" {{--  action="{{ url('save-comment/' . Str::slug($post->title) . '/' . $post->id) }}"  --}}>
                        @csrf
                        <textarea name="comment" class="form-control"></textarea>
                        <input type="submit" class="btn btn-primary mt-2" />
                </div>
            </div>
        @endauth

        <!-- Fetch Comments -->
        <div class="card my-4">
            <h5 class="card-header">Comments <span class="badge text-bg-dark">{{ count($post->comments) }}</span></h5>
            <div class="card-body">
                @if ($post->comments)
                    @foreach ($post->comments as $comment)
                        <figure>
                            <blockquote class="blockquote">
                                <p>{{ $comment->comment }}.</p>
                            </blockquote>
                            <figcaption class="blockquote-footer">
                                comment by <cite title="Source Title">{{ $comment->user->name }}</cite>
                            </figcaption>
                        </figure>
                        <hr />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
