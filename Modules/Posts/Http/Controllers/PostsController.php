<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Posts\Http\Models\Post;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller; 
  
class PostsController extends Controller
{
    /**
     * List all post.
     *
     * @return Response
     */
    public function index()
    {
        $data = Post::all();
        return Inertia::render('Post', ['data' => $data]);
    }
  
    /**
     * Create new post.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
  
        Post::create($request->all());
  
        return redirect('/posts')
                    ->with('message', 'Post Created Successfully.');
    }
  
    /**
     * Update post.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Post::find($request->input('id'))->update($request->all());
            return redirect('/posts')
                    ->with('message', 'Post Updated Successfully.');
        }
    }
  
    /**
     * Destroy post.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Post::find($request->input('id'))->delete();
            return redirect('/posts');
        }
    }
}