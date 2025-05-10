<x-layout.admin>
    <div>
        <h2>Infographics</h2>
        <h6>Thaboar's section :^)</h6>
        <hr/>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{route('admin.infographics.store')}}">
            @csrf
            <div class="mb-3">
                <label for="media" class="form-label">Upload New...</label>
                <input class="form-control" type="file" id="media" required name="media">
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
        <div class="row g-2">
        @foreach($infographics as $item)
            <div class="col-auto col-lg-3 col-md-4 g-3">
                <video loading="lazy" width="100%" loop="" autoplay="autoplay" class="gallery">
                    <source src="{{$item->url}}" type="video/mp4">
                </video>
                <form method="POST" action="{{route('admin.infographics.destroy', compact('item'))}}">
                    @csrf
                    <button class="text-danger btn btn-link m-0 p-0" type="submit">Delete</button>
                </form>
            </div>
        @endforeach
        </div>
    </div>
</x-layout.admin>
