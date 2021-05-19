<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">
                            All Brand
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Sl #.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                                    <td>{{ $brand->name }}</td>
                                    <td><img src="{{ asset($brand->image) }}" style="height: 40px"
                                             alt="{{ $brand->name }}"></td>
                                    <td>{{ $brand->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}"
                                           class="btn btn-info">Edit</a>
                                        <a href="{{ url('brand/delete/'.$brand->id) }}"
                                           onclick="return confirm('Are you sure to delete?')"
                                           class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('add.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Name:</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Image:</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
