@extends('layouts.app')

@section('content')

@if (session()->has('message'))
<div class="text-center ">
    <p class="w-50 my-2 m-auto bg-success rounded-2 py-2 text-white">
        {{ session()->get('message') }}
    </p>
</div>
@endif

<div class=" w-75 m-auto">
    <div class="card">
        <img src="{{ asset('images/' . $post->image_path) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-title"> By {{ $post->user->name }}, Created on
                {{ date('jS M Y', strtotime($post->updated_at)) }}.
            </p>
            <p class="card-text"> {{ $post->description }}</p>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
   
    <!-- Add Comment -->
    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
    <div class="card my-3">
        <h5 class="card-header">Add Comment</h5>
        <div class="card-body">
            <form method="post" action="{{ url('save-comment/' . $post->id) }}">
                @csrf
                <textarea name="comment" class="form-control"></textarea>
                @if ($errors->has('comment'))
                <div class="form-text text-danger">{{ $errors->first('comment') }}..!</div>
                @endif
                <input type="submit" class="btn btn-primary mt-2" value="Send" />
            </form>
        </div>
    </div>
    @endif
   
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

                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <div class=" mt-3">
                    <span class="float-start me-3 ">
                        <form action="/comments/{{ $comment->id }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>

                        </form>
                    </span>
                    <span>
                        <p>
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                Edit
                            </a>
                        </p>

                        <div class="collapse card" id="collapseExample">
                            <div class="card-body">
                                <form method="POST" action="{{ url('update-comment/' . $comment->id ) }}" >
                                    @csrf
                                    @method('PUT')
                                    <textarea name="comment" class="form-control">{{ $comment->comment }}</textarea>
                                    @if ($errors->has('comment'))
                                    <div class="form-text text-danger">{{ $errors->first('comment') }}..!</div>
                                    @endif
                                    <input type="submit" class="btn btn-primary mt-2" value="edit" />
                                </form>
                            </div>
                        </div>
                    </span>
                </div>
                @endif

            </figure>
            <hr />
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection