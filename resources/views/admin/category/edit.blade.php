<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Category</div>
                        <div class="card-body">
                            <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category Name:</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" value="{{ $category->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
