@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter Category Name" name="name" value="{{ old('name') ?? $category->name }}">
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="parent_id">Parent Category</label>
                                        <select  class="form-control" id="designation"
                                             name="parent_id">
                                        <option value="">Select Category</option>
                                        @foreach ($parentCategories as $item)
                                            <option value="{{$item->id}}" {{$category->parent_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('parent_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ old('description') ?? $category->description }}</textarea>
                                            @error('description')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.card -->
@endsection
