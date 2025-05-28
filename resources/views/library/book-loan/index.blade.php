@extends('layouts.master')

@section('title')
    Book Loan List
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @include('layouts.flash_message')

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <h3 class="card-title">Book Loan List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table id="dataTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Student Name</th>
                                            <th>Book Title</th>
                                            <th>Loan Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sn = 1;
                                            $queryString = request()->getQueryString(); // returns "category=books&user_id=5"
                                            // dd($queryString);
                                        @endphp
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $sn++ }}</td>
                                                <td>{{ $item->user->name ?? '' }}</td>
                                                <td>{{ $item->book->title ?? '' }}</td>
                                                <td>{{ $item->loan_date }}</td>
                                                <td>{{ $item->due_date }}</td>
                                                <td>{{ $item->return_date }}</td>
                                                <td> <span
                                                        class="{{ config('custom.loan_status_class')[$item->status] }}">{{ $item->status }}</span>
                                                </td>

                                                <td>
                                                    <a href="{{ route('book-loans.edit', $item->id) }}{{ $queryString ? '?' . $queryString : '' }}"
                                                        class="btn btn-sm btn-primary"><i
                                                            class="fa-solid fa-pencil"></i></a>

                                                    <button type="button" class="btn btn-sm btn-danger delete-item"
                                                        data-route="{{ route('book-loans.destroy', $item->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Student Name</th>
                                            <th>Book Title</th>
                                            <th>Loan Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
    <!-- /.card -->
@endsection

@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#dataTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "colvis"]
            }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-item').on('click', function(e) {
                let routeDelete = $(this).data('route');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this Item!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: routeDelete,
                            type: 'DELETE',
                            success: function(response) {
                                if (response.success) {

                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Item has been deleted Successfully.",
                                        color: "#d33",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                    setTimeout(function() {
                                        location.reload()
                                            .fadeIn(); // Or .show()
                                    }, 2000); // 2000 milliseconds = 2 seconds
                                } else {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: response.message,
                                        color: "#d33",
                                        showConfirmButton: false,
                                        timer: 5000
                                    });
                                }
                            },
                            error: function(xhr) {
                                alert('Something went wrong.');
                            }
                        });
                    }
                });
            })
        });
    </script>
@endsection
