@extends('layouts.app')

@section('content')

	<div class='container'>
		<div class='row'>
			<div class='col-lg-12'>
				<form action='{{ route('posts.store') }}' method='post' enctype='multipart/form-data'>
					@csrf
					<div class="form-group">
						<label for="title">title</label>
						<input type="text" class="form-control" id="title" name='title'>
					</div>
					@error('title')
						<div class='alert alert-danger'>{{ $message }}</div>
					@enderror

					<div class="form-group">
						<label for="image">Upload image</label>
						<input type="file" class="form-control-file" id="image" name='image'>
					</div>

					<button class='btn btn-primary'>Post</button>
				</form>
			</div>
		</div>
	</div>

@endsection
