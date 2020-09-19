<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class PostController extends Controller {
	public function index() {
		$posts = Post::all();

		return view('posts.index', [
			'posts' => $posts]
		);
	}

	public function create() {
		return view('posts.create');
	}

	public function store(Request $request) {
		Validator::make(
			$request->all(),
			[
				'title' => ['required', 'regex:/^[\w \']{4,100}$/'],
				'image' => ['image', 'nullable']
			],
			[
				'title.regex' => ':attribute need to be more than 4 alphanumeric characters'
			]
		)->validate();

		if ($request->hasFile('image')) {
			$image_url = storeImage($request->file('image'), 'public/images');
		} else {
			$image_url = 'public/images/noImage.png';
		}

		$post = new Post();
		$post->title = $request->input('title');
		$post->image_url = $image_url;
		$post->user_id = auth()->id();
		$post->save();
		return redirect()->route('posts.index')->with('success', 'Added post');
	}

	public function delete($id) {
		try {
			$post = Post::findOrFail($id);

			if ($post->image_url != 'noimage.png') {
				Storage::disk(env('STORAGE'))->delete($post->image_url);
			}

			$post->delete();
			return redirect()->route('posts.index')->with('success', 'Deleted post');
		} catch (Exception $exception) {
			error_log(print_r($exception));
			return redirect()->route('posts.index')->with('error', 'Fail to delete post');
		}
	}
}
