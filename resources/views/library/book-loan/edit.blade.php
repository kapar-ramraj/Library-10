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
                                <h3 class="card-title">Edit Book Loan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('book-loans.update', $bookLoan) }}" class="mb-4"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="queryString" value="{{request()->getQueryString()}}">
                                <!-- /.card-body -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="book_id">Book</label>
                                        <select class="form-control" id="book_id" name="book_id">
                                            <option value="">Select Book </option>
                                            @foreach ($books as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $bookLoan->book_id == $item->id ? 'selected' : '' }}>{{ $item->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('book_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Student </label>
                                        <select class="form-control" id="user_id" name="user_id">
                                            <option value="">Select student </option>
                                            @foreach ($students as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $bookLoan->user_id == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="loan_date">Loan date</label>
                                        <input type="date" class="form-control" id="loan_date" placeholder="loan_date"
                                            name="loan_date" value="{{ old('loan_date') ?? $bookLoan->loan_date }}">
                                        @error('loan_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="due_date">Due Date</label>
                                        <input type="date" class="form-control" id=""
                                            placeholder="Enter due_date" name="due_date" value="{{ old('due_date') ?? $bookLoan->due_date }}">
                                        @error('due_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputdue_date1">Return Date</label>
                                        <input type="date" class="form-control" id=""
                                            placeholder="Enter Death date" name="return_date"
                                            value="{{ old('return_date') ?? $bookLoan->return_date }}">
                                        @error('return_date')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Status </label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select Status </option>
                                            @foreach (config('custom.loan_status') as $item)
                                                <option value="{{ $item }}"
                                                    {{ $bookLoan->status == $item ? 'selected' : '' }}>{{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea  class="form-control" id="" placeholder="Enter notes"
                                            name="notes">
                                            {{old('notes') ?? $bookLoan->notes}}
                                        </textarea>
                                            @error('notes')
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
