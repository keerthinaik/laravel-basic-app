<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Multiple Images</div>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                @foreach($images as $image)
                                    <div class="col-4">
                                        <div class="card p-3">
                                            <img src="{{ asset($image->images) }}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form action="{{ route('add.images') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name:</label>
                                    <input type="file" name="images[]" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" multiple>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
