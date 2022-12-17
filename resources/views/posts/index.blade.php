@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="">
            <h3 >
                Blog Posts
            </h3>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="text-center ">
            <p class="w-50 mb-2 m-auto bg-success rounded-2 py-2 text-white">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    @if (Auth::check())
        <div class="py-3 m-auto text-center">
            <a href="{{ route('posts.create') }}"  class="btn btn-info">
                Create post
            </a>
        </div>
    @endif

    @foreach ($posts as $post)
        <div class="card m-auto mb-4" style="max-width: 90%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('images/' . $post->image_path) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $post->title }}</h5>
                        <p class="card-text"> By <span class="font-bold">{{ $post->user->name }}</span>, Created on
                            {{ date('jS M Y', strtotime($post->updated_at)) }}.</p>
                        <p class="card-text"> {{ $post->description }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary  rounded-2">
                            Keep Reading
                        </a>
    
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                            <div class=" mt-3">
                                 <span class="m-2">
                                    <a href="/posts/{{ $post->slug }}/edit"
                                        class="btn btn-info text-white">
                                        Edit
                                    </a>
                                </span>
    
                                <span class="float-start ">
                                    <form action="/posts/{{ $post->id }}" method="POST">
                                        @csrf
                                        @method('delete')
    
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
    
                                    </form>
                                </span>
                            </div>
                        @endif
                    </div>
                 
                </div>
            </div>
        </div>
    @endforeach
@endsection
