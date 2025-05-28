@extends('layouts.master')

@section('title')
    Dashboard
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
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalStudents }}</h3>

                                <p>Total Students</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalCategories }}</h3>

                                <p>Total Categories</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalAuthor }}</h3>

                                <p>Total Author</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('authors.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalPublisher }}</h3>

                                <p>Total Publishers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{ route('publishers.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- Main row -->
                <div class="row mt-4">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Total Number of Different Books : {{ $totalNoOfDifferentBooks }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Title</th>
                                            <th>No. Of Books</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $item)

                                        @php
                                            $bookStatusCount = App\Models\BookLoan::select(
                                            'book_id',
                                            \DB::raw('COUNT(CASE WHEN status = "borrowed" THEN 1 END) as status_borrowed'),
                                            \DB::raw('COUNT(CASE WHEN status = "returned" THEN 1 END) as status_returned'),
                                            \DB::raw('COUNT(CASE WHEN status = "overdue" THEN 1 END) as status_overdue')
                                        )
                                            ->where('book_id', $item->id)
                                            ->groupBy('book_id')
                                            ->first();
                                            // dd($bookStatusCount);
                                        @endphp
                                            <tr>
                                                <td><a href="pages/examples/invoice.html">{{$item->isbn}}</a></td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>
                                                    @if($bookStatusCount)
                                                        <span class="badge badge-primary">borrowed {{$bookStatusCount->status_borrowed}}</span>
                                                        <span class="badge badge-success">Available {{$item->quantity - $bookStatusCount->status_borrowed - $bookStatusCount->status_overdue}}</span>
                                                        <span class="badge badge-danger">overdue {{$bookStatusCount->status_overdue}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('book-loans.index').'?book_id='.$item->id}}" class="btn btn-sm btn-primary">view</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="row mt-4">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card col-md-12">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Total Number of Students : {{ $totalStudents }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0" id="studentTable">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>No. Of Books</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $item)

                                        @php
                                            $studentStatusCount = App\Models\BookLoan::select(
                                            'user_id',
                                            \DB::raw('COUNT(CASE WHEN status = "borrowed" THEN 1 END) as status_borrowed'),
                                            \DB::raw('COUNT(CASE WHEN status = "returned" THEN 1 END) as status_returned'),
                                            \DB::raw('COUNT(CASE WHEN status = "overdue" THEN 1 END) as status_overdue')
                                        )
                                            ->where('user_id', $item->id)
                                            ->groupBy('user_id')
                                            ->first();
                                            // dd($studentStatusCount);
                                        @endphp
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{config('custom.student_can_take_books')}}</td>
                                                <td>
                                                    @if($studentStatusCount)
                                                        <span class="badge badge-primary">borrowed {{$studentStatusCount->status_borrowed}}</span>
                                                        <span class="badge badge-danger">overdue {{$studentStatusCount->status_overdue}}</span>
                                                        <span class="badge badge-success">Available {{config('custom.student_can_take_books') - $studentStatusCount->status_borrowed - $studentStatusCount->status_overdue}}</span>

                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('book-loans.index').'?user_id='.$item->id}}" class="btn btn-sm btn-primary">view</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
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

            $("#studentTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "colvis"]
            }).buttons().container().appendTo('#studentTable_wrapper .col-md-6:eq(0)');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection
