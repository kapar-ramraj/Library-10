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
                                <h3 class="card-title">Create User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="/user/store" class="mb-4">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" id="fname"
                                            placeholder="Enter First Name" name="fname" value="{{old('fname')}}">
                                        @error('fname')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" id=""
                                            placeholder="Enter First Name" name="lname" value="{{old('lname')}}">
                                            @error('lname')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="" placeholder="Enter Email"
                                            name="email" value="{{old('email')}}">
                                            @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter Phone"
                                            name="phone" value="{{old('phone')}}">
                                            @error('phone')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            placeholder="Password" name="password" value="{{old('password')}}">
                                            @error('password')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="user_type">User Type </label>
                                        <select  class="form-control" id="user_type"
                                             name="user_type" required>
                                        <option value="">Select User Type </option>
                                        @foreach (config('custom.user_types') as $item)
                                        <option value="{{$item}}" {{old('user_type') == $item ? 'selected' : ''}}>{{ $item }}</option>
                                        @endforeach
                                        </select>
                                        @error('user_type')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Role </label>
                                        <select  class="form-control" id="role_name"
                                             name="role_name">
                                        <option value="">Select Role </option>
                                        @foreach ($roles as $item)
                                        <option value="{{$item->name}}" {{ old('role_name') == $item->name ? 'selected' : ''}}>{{$item->name }}</option>
                                        @endforeach
                                        </select>
                                        @error('role_name')
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
