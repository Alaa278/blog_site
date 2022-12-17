@extends('layouts.app')

@section('content')

<div class="card w-75 m-auto">
    <div class="card-header">
      <h5>  {{ $post->title }} </h5>
    </div>
    <div class="card-body">
        
      <p class="card-title">   By {{ $post->user->name }}, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}.</p>
      <p class="card-text"> {{$post->description}}</p>
      <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
    </div>
  </div>

@endsection 