@extends('layouts.app')

@section('content')
	<div class='container'>
		@if(session('success'))
			<div class='alert alert-success'>{{ session('success') }}</div>
		@endif

		@if(session('error'))
			<div class='alert alert-danger'>{{ session('error') }}</div>
		@endif

		<a href='{{ route('posts.create') }}' class='btn btn-success'>ADD</a>

		<div class='row'>
			@foreach($posts as $post)
			<div class='col-lg-6 my-2'>
				<div class='shadow bg-white p-3'>
					<h2 class='mb-3'>{{ $post->title }}</h2>
					<img src='{{ Storage::disk(env('STORAGE'))->url($post->image_url) }}' alt='image' class='img-fluid'>
					<form action='{{ route('posts.delete', $post->id) }}' method='post'>
						@csrf
						@method('delete')
						<button class='btn btn-danger mt-3'>Delete</button>
					</form>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection
