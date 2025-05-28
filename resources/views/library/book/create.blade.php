@extends('layouts.master')

@section('title')
Create Book
@endsection

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
                                <h3 class="card-title">Create book</h3>
                            </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('books.store')}}" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Title</label>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="title" name="title" value="{{old('title')}}">
                                        @error('title')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Isbn</label>
                                        <input type="text" class="form-control" id="isbn"
                                            placeholder="isbn" name="isbn" value="{{old('isbn')}}">
                                        @error('isbn')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Author </label>
                                        <select  class="form-control" id="author_id"
                                             name="author_id">
                                        <option value="">Select author </option>
                                        @foreach ($authors as $item)
                                        <option value="{{$item->id}}" {{old('author_id') == $item->id ? 'selected' : ''}}>{{$item->name }}</option>
                                        @endforeach
                                        </select>
                                        @error('author_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Publisher </label>
                                        <select  class="form-control" id="publisher_id"
                                             name="publisher_id">
                                        <option value="">Select publisher </option>
                                        @foreach ($publishers as $item)
                                        <option value="{{$item->id}}" {{old('publisher_id') == $item->id ? 'selected' : ''}}>{{ $item->name  }}</option>
                                        @endforeach
                                        </select>
                                        @error('publisher_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Category </label>
                                        <select  class="form-control" id="category_id"
                                             name="category_id">
                                        <option value="">Select category </option>
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}" {{old('category_id') == $item->id ? 'selected' : ''}}>{{$item->name }}</option>
                                        @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Publication year</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter publication_year"
                                            name="publication_year" value="{{old('publication_year')}}">
                                            @error('publication_year')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Quantity</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter Death date"
                                            name="quantity" value="{{old('quantity')}}">
                                            @error('quantity')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Description</label>
                                        <textarea  class="form-control" id="" placeholder="Enter description"
                                            name="description">
                                            {{old('description')}}
                                        </textarea>
                                            @error('description')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cover_image">Cover image</label>
                                        <input type="file" class="form-control" id="cover_image"
                                            placeholder="cover_image" name="cover_image" value="{{old('cover_image')}}">
                                            @error('cover_image')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
