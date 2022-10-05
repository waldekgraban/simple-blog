@extends('layout.app')

@section('content')
    <div class="bg-info p-5 rounded">
        @auth
            <h1>Dashboard</h1>
            <p class="lead">You are logged.</p>

                @if ($isUserAllowToMenagePosts)
                    <a class="w-100 btn btn-lg btn-primary mt-5" href="{{ route('posts.index') }}">Manage posts</a>
                @endif

                @if ($isUserAllowToMenageUsers)
                    <a class="w-100 btn btn-lg btn-primary mt-5" href="{{ route('users.index') }}">Manage users</a>
                @endif

        @endauth

        @guest
            <h1>Homepage</h1>
            <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
    <h3 class="p-4">List of posts</h3>
    <div >
        @foreach ($posts as $post)
        <div class="bg-light p-5 mt-4 rounded border">
            <h4>Title: {{ $post->title }}</h4>

            <span>Body: {{ $post->body }}<span>
            @if (isset(json_decode($post->post_images)[0]))
                <p>Image:</p>
                <img class="col-6" src="{{ URL::to('/') .'/' . json_decode($post->post_images)[0]->post_image_path }}">
            @endif
            <hr>
        </div>            
        @endforeach
    </div>
    {!! $posts->links() !!}

@endsection