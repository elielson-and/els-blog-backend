<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return response()->json($post, Response::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user(); // Auth factory
        $this->validate($request, [
            'title' => 'required|unique:posts|max:180',
            'description' => 'required|max:255',
            'content' => 'required'
        ]);

        $post = Post::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->input('title'), "-"),
            'description' => $request->description,
            'content'     => $request->content,
            'user_id'     => $user->id
        ]);

        return response()->json(['created' => $post], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $postData = Post::where('slug', $slug)->first();
        $author = User::where('id', $postData->user_id)->first()->name;
        $postData->author = $author;
        unset($postData->user_id);
        unset($postData->created_at);
        unset($postData->id);
        return response()->json($postData, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|unique:posts,title,' . $post->id . '|max:180',
            'description' => 'sometimes|required|max:255',
            'content' => 'sometimes|required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $post->fill($request->only(['title', 'description', 'content']));

        $post->save();

        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::where('id', $post->id)->delete();
        return response()->json($post, Response::HTTP_OK);
    }
}
