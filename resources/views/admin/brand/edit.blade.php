@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $brand->image }}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Name:</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" value="{{ $brand->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}"
                                         style="height: 100px">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Brand Image:</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                    @error('image')
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
@endsection

