<?php

namespace App\Http\Controllers;

use App\Models\Infographic;
use App\Models\Post;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfographicController extends Controller
{

    public function index()
    {
        $infographics = Infographic::all();
        return view('admin.infographics', compact('infographics'));
    }


    public function store(Request $request, Post $post)
    {
        $request->validate([
            'media' => 'nullable|file|mimes:mp4'
        ]);

        if($request->hasFile('media')){
            $request->file('media')->store('public/images/infographics');
            $post->image_url = $request->file('media')->hashName();
        }

        Infographic::create([
            'image_path' => $request->file('media')->hashName(),
        ]);

        return redirect()->back();

    }

    public function destroy(Infographic $item)
    {
        Storage::disk('public')->delete("images/infographics/{$item->image_path}");
        $item->delete();
        return redirect()->back();
    }
}
