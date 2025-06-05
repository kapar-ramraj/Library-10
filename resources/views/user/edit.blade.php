@extends('layouts.master')
@section('title')
    Update User
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
                                <h3 class="card-title">Edit User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('user.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter First Name" name="fname" value="{{ old('fname') ?? $user->fname }}">
                                        @error('fname')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input type="text" class="form-control" id=""
                                            placeholder="Enter Last Name" name="lname" value="{{ old('lname') ?? $user->lname }}">
                                        @error('lname')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" id="" placeholder="Enter Email"
                                            name="email" value="{{ old('email') ?? $user->email }}">
                                        @error('email')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="number" class="form-control" id="" placeholder="Enter Phone"
                                            name="phone" value="{{ old('phone') ?? $user->phone }}">
                                        @error('phone')
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
                                        <option value="{{$item}}" {{$user->user_type == $item ? 'selected' : ''}}>{{ $item }}</option>
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
                                             name="role_name" required>
                                        <option value="">Select Role </option>
                                        @foreach ($roles as $item)
                                        <option value="{{$item->name}}" {{in_array($item->name,$useAssignedRole) ? 'selected' : ''}}>{{$item->name }}</option>
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
