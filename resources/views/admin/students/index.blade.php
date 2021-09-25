@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-sm-6 mb-4 pl-2">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-info btn-flat btn-md" href="{{ route('submitStudent') }}">Add New
                            Student </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="custom_students_listing">
                        <table id="students_listing"
                               class="table table-bordered table-striped display responsive nowrap" cellspacing="0"
                               width="100%">
                            @php
                                $count = 1;
                            @endphp
                        <thead>
                        <tr>
                            <th style="width: 10px">Sr. No.</th>
                            <th>Registration No</th>
                            <th>Full Name</th>
                            <th>Guardian Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Class</th>
                            <th>Session</th>
                            <th>QR</th>
                            {{--                            <th style="width:120px;">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = ($students->currentPage()-1) *10;
                        @endphp
                        @foreach($students as $student)
                            <tr id="student_{{$student->id}}">
                                <td>{{$count+1 }}</td>
                                <td>{{ $student->registration_no }}</td>
                                <td>{{ $student->candidate_name }}</td>
                                <td>{{ $student->guardian_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->class_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->started_date)->format('Y') }}-{{ \Carbon\Carbon::parse($student->ended_date)->format('Y') }}</td>
                                <td><img src="{{$student->qr_image}}" style="width:100px"></td>
                            </tr>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                        </tbody>
                        </table>
                        {{$students->links()}}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>

@endsection

@section('scripts')
    <script src="{{asset('public/js/student.js?v=1')}}"></script>
    <script>
        var success = "{{ session('success') }}"
        if (success.length) {
            toastr.success(success);
        }
    </script>
@endsection
