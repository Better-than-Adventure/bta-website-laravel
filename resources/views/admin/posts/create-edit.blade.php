@props(['post'])

@php
    $type = request()->get('type') ?? null;
    $postTypeQuery = \App\Models\PostType::query();
    if($type === 'gallery'){
        $postTypeQuery = \App\Models\PostType::where('post_template_enum', \App\Enums\EnumPostTemplates::Gallery);
    }
@endphp

<x-layout.admin>
    <div>
        <h2>Create New Post</h2>
        <hr/>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" class="row" action="{{ $post->exists ? route('admin.posts.update', [$post]) : route('admin.posts.store') }}">
            @csrf
            <div class="col-md-9">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required name="title" value="{{old('title', $post->title)}}" placeholder="Title">
                    <label for="floatingInput">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required name="summary" value="{{old('summary', $post->summary)}}" placeholder="Summary">
                    <label for="floatingInput">Summary</label>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="contentOld" name="contentOld" value="{{old('content', $post->content)}}">
                    <textarea id="mdeTextEditor" name="content" rows="4" cols="50"></textarea>
                </div>

            </div>
            <div class="col-md-3">
                <x-admin-container title="Media" width="250">
                    <div class="p-3">
                        @if($post->exists && filled($post->header_image_url))
                            <img src="{{asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)}}" style="height: 200px; object-fit:cover;" class="card-img-top mb-3">
                        @endif
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="header" class="form-label">Header Image</label>
                                <input class="form-control" type="file" id="header" name="header">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="video_code" value="{{old('video', $post->video)}}">
                                <label for="floatingInput">Video code</label>
                            </div>
                        </div>
                    </div>
                </x-admin-container>
                <x-admin-container title="Meta" width="250">
                    <div class="p-3">
                        <p class="card-text"><span>Post Type:</span>
                            <select name="post_type" class="form-select">
                                @foreach($postTypeQuery->get() as $postType)
                                    <option value="{{$postType->id}}" @if($post->exists && $post->postType?->id == $postType->id) selected @endif>{{$postType->name}}</option>
                                @endforeach
                            </select>
                        <p class="card-text"><span>Tags:</span>
                            <input type="text" class="form-control" @if($post->exists) value="{{$post->formatted_tags}}" @endif name="tags" id="tagInput" placeholder="No tags assigned."/>
                    </div>
                </x-admin-container>
                <x-admin-container title="Publish" width="250">
                    <div class="p-3">
                        <div class="card-text mb-3"><span>Current Status: </span>@if($post->exists){!! $post->status !!}@else draft @endif</div>
                        <div class="card-text">Schedule post to go live at:</div>
                        <input class="form-control"
                               type="datetime-local"
                               id="publish-date"
                               name="publish_at"
                               value="{{old('published_at', $post->published_at)}}"/>
                        <hr/>
                        <div>
                            @if(!$post->exists || $post->is_draft)
                                <button type="submit" name="action" class="btn btn-primary">Save and publish</button>
                                <button type="submit" name="action" value="draft" class="btn btn-outline-primary">Save as Draft</button>
                            @else
                                <button type="submit" name="action" class="btn btn-outline-primary">Save Edits</button>
                            @endif
                        </div>
                    </div>
                </x-admin-container>
            </div>
        </form>
    </div>
</x-layout.admin>
