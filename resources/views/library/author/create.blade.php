@extends('layouts.master')

@section('title')
Create Author
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
                                <h3 class="card-title">Create Author</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('authors.store')}}" class="mb-4" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputbirth_date1">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Full Name" name="name" value="{{old('name')}}">
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nationality</label>
                                        <select  class="form-control" id="nationality"
                                             name="nationality">
                                        <option value="">Select nationality</option>
                                        @foreach ($countries as $item)
                                        <option value="{{$item->id}}">{{$item->nationality}}</option>
                                        @endforeach
                                        </select>
                                        @error('nationality')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputbirth_date1">Birth Date</label>
                                        <input type="date" class="form-control" id="" placeholder="Enter birth_date"
                                            name="birth_date" value="{{old('birth_date')}}">
                                            @error('birth_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputbirth_date1">Death date</label>
                                        <input type="date" class="form-control" id="" placeholder="Enter Death date"
                                            name="death_date" value="{{old('death_date')}}">
                                            @error('death_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputbirth_date1">Biography</label>
                                        <textarea  class="form-control" id="" placeholder="Enter biography"
                                            name="biography">
                                            {{old('biography')}}
                                        </textarea>
                                            @error('biography')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" class="form-control" id="photo"
                                            placeholder="photo" name="photo" value="{{old('photo')}}">
                                            @error('photo')
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
