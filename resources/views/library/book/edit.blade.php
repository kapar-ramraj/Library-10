@extends('layouts.master')

@section('title')
    Edit Book
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
                                <h3 class="card-title">Edit Book</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('books.update', $book) }}" class="mb-4"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- /.card-body -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="title"
                                            name="title" value="{{ old('title') ?? $book->title }}">
                                        @error('title')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Isbn</label>
                                        <input type="text" class="form-control" id="isbn" placeholder="isbn"
                                            name="isbn" value="{{ old('isbn') ?? $book->isbn }}">
                                        @error('isbn')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Author </label>
                                        <select class="form-control" id="author_id" name="author_id">
                                            <option value="">Select author </option>
                                            @foreach ($authors as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $book->author_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
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
                                        <select class="form-control" id="publisher_id" name="publisher_id">
                                            <option value="">Select publisher </option>
                                            @foreach ($publishers as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $book->publisher_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
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
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select category </option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $book->category_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
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
                                        <input type="number" class="form-control" id=""
                                            placeholder="Enter publication_year" name="publication_year"
                                            value="{{ old('publication_year') ?? $book->publication_year }}">
                                        @error('publication_year')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputpublication_year1">Quantity</label>
                                        <input type="number" class="form-control" id=""
                                            placeholder="Enter Death date" name="quantity"
                                            value="{{ old('quantity') ?? $book->quantity }}">
                                        @error('quantity')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="" name="description" cols="30" rows="3">
                                            {{ old('description') ?? $book->description }}
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
                                            placeholder="cover_image" name="cover_image" value="{{ old('cover_image') }}">
                                        @if ($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Book Cover"
                                                width="100px" class="mt-2">
                                        @endif
                                        @error('cover_image')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>
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
