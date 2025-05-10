<?php

namespace App\Http\Controllers;

use App\DataTables\PostMediaDataTable;
use App\DataTables\PostsDataTable;
use App\Enums\EnumPostTemplates;
use App\Models\GalleryItem;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = request()->get('type');
        $postsDataTable = new PostsDataTable($type);
        return $postsDataTable->render('admin.posts.list', ['type' => $type]);
    }

    public function media(PostType $postType, Post $post)
    {
        $dataTable = new PostMediaDataTable($post->id);
        return $dataTable->render('admin.posts.media', ['post' => $post]);
    }

    public function storeMedia(Request $request, Post $post)
    {
        $validated = $request->validate([
            'description' => 'string|nullable',
            'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4'
        ]);

        if($request->hasFile('media')){
            $request->file('media')->store('public/images/content/'.$post->slug.'/media');
            $post->image_url = $request->file('media')->hashName();
        }

        GalleryItem::create([
            'image_path' => $request->file('media')->hashName(),
            'image_description' => $validated['description'],
            'post_id' => $post->id,
        ]);

        return redirect()->back();

    }

    public function deleteMedia(Post $post, GalleryItem $galleryItem)
    {
        Storage::disk('public')->delete("images/content/{$post->slug}/media/{$galleryItem->image_path}");
        $galleryItem->delete();

        return redirect()->back();

    }

    /**
     * Display a listing of the resource.
     */
    public function view(PostType $postType, Post $post)
    {
        if($postType->post_template_enum == EnumPostTemplates::Article)
            return view('posts.article', compact('post'));
        else if($postType->post_template_enum == EnumPostTemplates::Gallery)
            return view('posts.gallery', compact('post'));
        else
            return view('posts.page', compact('post'));
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
    public function edit(Post $post)
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
            'summary' => 'nullable|max:255',
            'content' => 'nullable',
            'video_code' => 'nullable|max:11',
            'header' => 'nullable|image|mimes:jpeg,jpg,png,gif'
        ]);

        $post->fill($validated);

        if(!$post->slug){
            $post->slug = Str::slug($post->title);
        }

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

        if($request->has('video_code')){
            $post->video = $request->get('video_code');
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

    public function destroy(Post $post)
    {
        $post->tags()->detach();
        Storage::disk('public')->deleteDirectory("images/content/{$post->slug}");
        $post->delete();
    }
}
