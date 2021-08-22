@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid px-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a class="btn btn-info btn-flat btn-md" href="{{ route('listStudents') }}">Back </a>
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
                            <h3 class="card-title">Add Student</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('storeStudent') }}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Candidate Name <span class="required-star">*</span></label>
                                        <input type="text" id="candidate_name" name="candidate_name"
                                               class="form-control @error('candidate_name') is-invalid @enderror"
                                               placeholder="Enter Candidate Name" required>
                                        @if ($errors->has('candidate_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('candidate_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Guardian Name <span class="required-star">*</span></label>
                                        <input type="text" id="guardian_name"
                                               class="form-control @if ($errors->has('guardian_name')) is-invalid @endif"
                                               name="guardian_name"
                                               placeholder="Enter Email Address" value="{{ old('guardian_name') }}"
                                               required>

                                        @if ($errors->has('guardian_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('guardian_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email <span
                                                class="required-star">*</span></label>
                                        <input type="text"
                                               class="form-control @if ($errors->has('email')) is-invalid @endif"
                                               name="email" id="email"
                                               placeholder="Enter Email" value="{{ old('email') }}"
                                               required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone No <span
                                                class="required-star">*</span></label>
                                        <input type="text"
                                               class="form-control @if ($errors->has('certification_no')) is-invalid @endif"
                                               name="phone" id="phone"
                                               placeholder="Enter Phone" value="{{ old('phone') }}"
                                               required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Class <span class="required-star">*</span></label>
                                        <input type="text" id="class_name"
                                               class="form-control @if ($errors->has('class_name')) is-invalid @endif"
                                               name="class_name" placeholder="Enter Class" required>
                                        @if ($errors->has('class_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('class_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Department <span class="required-star">*</span></label>
                                        <input type="text" id="department_name"
                                               class="form-control @if ($errors->has('department_name')) is-invalid @endif"
                                               name="department_name" placeholder="Enter Department" required>
                                        @if ($errors->has('department_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('department_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Address <span class="required-star">*</span></label>
                                        <input type="text" id="address"
                                               class="form-control @if ($errors->has('address')) is-invalid @endif"
                                               name="address" placeholder="Enter Address" required>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Date Of Birth <span class="required-star">*</span></label>
                                        <input type="date" id="date"
                                               class="form-control date @if ($errors->has('date_of_birth')) is-invalid @endif"
                                               name="date_of_birth" placeholder="Enter Date Of Birth" required>
                                        @if ($errors->has('date_of_birth'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Campus Name <span class="required-star">*</span></label>
                                        <input type="text" id="name_campus"
                                               class="form-control @if ($errors->has('name_campus')) is-invalid @endif"
                                               name="name_campus" placeholder="Enter Campus Name" required>
                                        @if ($errors->has('name_campus'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_campus') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Batch No <span class="required-star">*</span></label>
                                        <input type="text" id="batch_no"
                                               class="form-control @if ($errors->has('batch_no')) is-invalid @endif"
                                               name="batch_no" placeholder="Enter Batch No" required>
                                        @if ($errors->has('batch_no'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('batch_no') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Profile Image <span class="required-star">*</span></label>
                                        <input type="file" id="profile_image"
                                               class="form-control @if ($errors->has('profile_image')) is-invalid @endif"
                                               name="profile_image" placeholder="Enter Profile" required>
                                        @if ($errors->has('profile_image'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_image') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>CNIC <span class="required-star">*</span></label>
                                        <input type="text" id="cnic"
                                               class="form-control @if ($errors->has('cnic')) is-invalid @endif"
                                               name="cnic" placeholder="Enter CNIC" required>
                                        @if ($errors->has('cnic'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cnic') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Started Year <span class="required-star">*</span></label>
                                        <input id="date" type="date"
                                               class="form-control date @if ($errors->has('started_year')) is-invalid @endif"
                                               placeholder="Enter Started Year" name="started_year" required>
                                        @if ($errors->has('started_year'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('started_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Ended year <span class="required-star">*</span></label>
                                        <input type="date" id="date"
                                               class="form-control date @if ($errors->has('ended_year')) is-invalid @endif"
                                               name="ended_year" placeholder="Enter Ended year " required>
                                        @if ($errors->has('ended_year'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ended_year') }}</strong>
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
