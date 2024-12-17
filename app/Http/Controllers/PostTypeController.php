<?php

namespace App\Http\Controllers;

use App\DataTables\PostTypesDataTable;
use App\Models\Post;
use App\Models\PostType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostTypeController extends Controller
{
    /**
     * Display a paginated list of posts.
     */
    public function list(PostType $postType)
    {

        $posts = Post::where('post_type_id', $postType->id)
            ->where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(10);
        return view('posts.list')->with(compact('posts'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostTypesDataTable $dataTable)
    {

        return $dataTable->render('admin.post_types.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postType = new PostType;
        return view('admin.post_types.create-edit')->with(compact('postType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postType = new PostType;

        $validated = $request->validate([
            'name' => 'required|unique:post_types|max:255',
        ]);

        $postType->fill($validated);
        $postType->save();

        return redirect(route('admin.postTypes'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $postTypeId)
    {
        $postType = Post::findOrFail($postTypeId);
        return view('admin.post_types.create-edit')->with(compact('postType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $postTypeId)
    {
        $postType = PostType::findOrFail($postTypeId);

        $validated = $request->validate([
            'name' => 'required|unique:post_types,name,'.$postType->id.'|max:255',
        ]);

        $postType->fill($validated);
        $postType->save();

        return redirect(route('admin.postTypes'));
    }
}
