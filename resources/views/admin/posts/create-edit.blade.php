
@props(['post'])

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
                <div class="card mb-3">
                    <h5 class="card-header">Media</h5>
                    @if($post->exists && filled($post->header_image_url))
                    <img src="{{asset('images/content/'.$post->slug.'/header/'.$post->header_image_url)}}" style="height: 200px; object-fit:cover;" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <input type="file" id="header" name="header" class="mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required name="video" value="{{old('video', $post->video)}}" placeholder="Video">
                            <label for="floatingInput">Video</label>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <h5 class="card-header">Meta</h5>
                    <div class="card-body">
                        <p class="card-text"><span>Post Type:</span>
                        <select name="post_type" class="form-select">
                            @foreach(\App\Models\PostType::all() as $postType)
                                <option value="{{$postType->id}}" @if($post->exists && $post->postType?->id == $postType->id) selected @endif>{{$postType->name}}</option>
                            @endforeach
                        </select>
                        <p class="card-text"><span>Tags:</span>
                        <input type="text" class="form-control" @if($post->exists) value="{{$post->formatted_tags}}" @endif name="tags" id="tagInput" placeholder="No tags assigned."/>
                    </div>
                </div>
                <div class="card mb-3">
                    <h5 class="card-header">Publish</h5>
                    <div class="card-body">
                            <div class="card-text mb-3"><span>Current Status: </span>@if($post->exists){!! $post->status !!}@else draft @endif</div>
                        <div class="card-text">Schedule post to go live at:</div>
                        <input class="form-control"
                            type="datetime-local"
                            id="publish-date"
                            name="publish_at" />
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
                </div>
            </div>
        </form>
    </div>
</x-layout.admin>
