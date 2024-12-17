<?php

namespace App\Http\Controllers;

use App\DataTables\PostsDataTable;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(PostsDataTable $postsDataTable)
    {

        return $postsDataTable->render('admin.posts.list');
    }

    /**
     * Display a listing of the resource.
     */
    public function view(PostType $postType, Post $post)
    {

        return view('posts.view', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post;
        return view('admin.posts.create-edit')->with(compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->storeAndUpdate($request, new Post);
        return redirect(route('admin.posts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('admin.posts.create-edit')->with(compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::findOrFail($post->id);
        $this->storeAndUpdate($request, $post);

        return redirect(route('admin.posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function storeAndUpdate(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'content' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif'
        ]);

        $post->fill($validated);

        if($request->input('action') != "draft")
            $post->draft = false;

        if ($request->filled('publish_at'))
            $post->published_at = $request->get('publish_at');
        else
            $post->published_at = now();

        $post->author_id = auth()->user()->id;

        if($request->hasFile('header')){
            $request->file('header')->store('public/images/content/'.$post->slug.'/header');
            $post->header_image_url = $request->file('header')->hashName();
        }

        $postTypeId = $request->get("post_type");
        $postType = PostType::findOrFail($postTypeId);
        $post->postType()->associate($postType);

        $post->save();

        $tags = explode(',', $request->get('tags'));
        $post->tags()->detach();

        foreach ($tags as $tag_string) {
            // if tag is pure whitespace, just ignore it.
            if(ctype_space($tag_string))
                continue;

            $tag = Tag::firstOrCreate(['slug' =>  Str::slug($tag_string)], ['name' => $tag_string]);
            $post->tags()->syncWithoutDetaching([$tag->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
