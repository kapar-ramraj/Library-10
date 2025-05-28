@extends('layouts.master')

@section('title')
Create Publisher
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
                                <h3 class="card-title">Create Publisher</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('publishers.store')}}" class="mb-4">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputcity1">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Full Name" name="name" value="{{old('name')}}">
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Country</label>
                                        <select  class="form-control" id="country"
                                             name="country">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        </select>
                                        @error('country')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputcity1">City</label>
                                        <input type="city" class="form-control" id="" placeholder="Enter city"
                                            name="city" value="{{old('city')}}">
                                            @error('city')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputcity1">Address</label>
                                        <input type="city" class="form-control" id="" placeholder="Enter Address"
                                            name="address" value="{{old('address')}}">
                                            @error('address')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputcity1">Phone</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter Phone"
                                            name="phone" value="{{old('phone')}}">
                                            @error('phone')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Email" name="email" value="{{old('email')}}">
                                            @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputcity1">website</label>
                                        <input type="text" class="form-control" id="" placeholder="Enter website"
                                            name="website" value="{{old('website')}}">
                                            @error('website')
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
