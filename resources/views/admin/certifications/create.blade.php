@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid px-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Certifications</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-info btn-flat btn-md" href="{{ route('listCertificates') }}">Back </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- general form elements -->
                    <div class="card card-info col-md-12 px-0">
                        <div class="card-header">
                            <h3 class="card-title">Add Certification</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('storeCertificate') }}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            @php
                                $data = session()->get('data');
                            @endphp
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="registration_no">Student <span
                                                class="required-star">*</span></label>
                                        <select name="student_id" id="student_id"
                                                class="form-control @if ($errors->has('student_id')) is-invalid @endif"
                                                required>
                                            <option value="" disabled selected>Select Student</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}"
                                                    {{(old('student_id') == $student->id)? 'selected' : ''}}>
                                                    {{ $student->candidate_name }}-{{ $student->class_name }}
                                                    -{{ $student->department_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                        <div class=""><strong>{{ $message }}</strong></div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label>Total Marks <span class="required-star">*</span></label>
                                        <input id="started_year" type="number"
                                               class="form-control @if ($errors->has('total_marks')) is-invalid @endif"
                                               placeholder="Enter Total Marks" name="total_marks" required>
                                        @if ($errors->has('total_marks'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_marks') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Obtain Marks <span class="required-star">*</span></label>
                                        <input type="number" id="obtain_marks"
                                               class="form-control @if ($errors->has('obtain_marks')) is-invalid @endif"
                                               name="obtain_marks" placeholder="Enter Obtain Marks " required>
                                        @if ($errors->has('obtain_marks'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('obtain_marks') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>CGPA <span class="required-star">*</span></label>
                                        <input id="cgpa" type="number" step="0.01"
                                               class="form-control @if ($errors->has('cgpa')) is-invalid @endif"
                                               placeholder="Enter CGPA" name="cgpa" required>
                                        @if ($errors->has('cgpa'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cgpa') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-info btn-flat">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('public/js/certification.js?v=1')}}"></script>
    <script>
        // Vanilla Javascript
        var input = document.querySelector("#contact_no");
        window.intlTelInput(input, ({
            // options here
        }));

        // jQuery
        $("#contact_no").intlTelInput({
            // options here
        });
    </script>
@endsection
