@extends('layouts.app')

@section('content')
    <div class=" m-auto text-center">
        <div class="py-15">
            <h3 class="text-6xl">
                Create Post
            </h3>
        </div>
    </div>

    <div class="w-75 m-auto">
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="title" placeholder="Title..." class="form-control">
                @if ($errors->has('title'))
                    <div class="form-text text-danger">{{ $errors->first('title') }}..!</div>
                @endif
            </div>
            <div class="mb-3">
                <textarea name="description" placeholder="Description..." class="form-control"></textarea>
                @if ($errors->has('description'))
                <div class="form-text text-danger">{{ $errors->first('description') }}..!</div>
            @endif
            </div>

            <div class=" mb-3">
                <label class="form-control">
                    <span class="">
                        Select a file
                    </span>
                    <input type="file" name="image" class="hidden">
                </label>
                @if ($errors->has('image'))
                <div class="form-text text-danger">{{ $errors->first('image') }}..!</div>
            @endif
            </div>

            <button type="submit" class="btn btn-primary">
                Submit Post
            </button>
        </form>
    </div>
@endsection
