@extends('layouts.master')

@section('title')
    Create Role
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
                                <h3 class="card-title">Create Role and Assign Permissions</h3>
                            </div>

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('roles.store') }}" class="mb-4"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="book_id">Role Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Role Name"
                                            name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="row mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input Checked_All" type="checkbox">
                                            <label class="form-check-label"> Checked All</label>
                                        </div>
                                    </div>
                                    @foreach ($chunks as $permission4)
                                        <div class="row mt-2">
                                            @foreach ($permission4 as $item)
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permission[]"
                                                            value="{{ $item->name }}">
                                                        <label class="form-check-label">{{ $item->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
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
@section('scripts')
    <script>
        $(document).on('change', '.Checked_All', function() {
            $('.form-check-input').prop('checked', $(this).is(':checked'));
        });
    </script>
@endsection
