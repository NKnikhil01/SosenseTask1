@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Post\'s Links') }}
                    <a href="{{ route('user.add-post') }}" class="btn btn-primary float-end">Add Post</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-light table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">image</th>
                                <th scope="col">discreption</th>
                                <th scope="col">Status</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($posts)
                                @foreach ($posts as $post)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td><img src="{{ Storage::url($post->image) }}" class="img-circle" style="height: 50px; width: 50px;"></td>
                                        <td>{{ $post->description }}</td>
                                        <td>{{ $post->status }}</td>
                                        <td>{{ $post->category_id  }}</td>
                                        <td>
                                            <a href="{{ route('user.edit-post', $post->id) }}">Edit</a> | 
                                            <a href="{{ route('user.delete-post', $post->id) }}">Delete</a>
                                        </td>
                                    </tr>    
                                @endforeach     
                            @endisset
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
