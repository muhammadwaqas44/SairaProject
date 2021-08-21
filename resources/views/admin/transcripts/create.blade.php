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
                        <a class="btn btn-info btn-flat btn-md" href="{{ route('listTranscripts') }}">Back </a>
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
                        <form role="form" action="{{ route('storeTranscript') }}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            @php
                                $data = session()->get('data');
                            @endphp
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="registration_no">Registration No <span
                                                class="required-star">*</span></label>
                                        <input type="text"
                                               class="form-control @if ($errors->has('registration_no')) is-invalid @endif"
                                               name="registration_no" id="registration_no"
                                               placeholder="Enter Registration No" value="{{ old('registration_no') }}"
                                               required>
                                        @error('registration_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('registration_no') }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="certification_no">Certification No <span
                                                class="required-star">*</span></label>
                                        <input type="text"
                                               class="form-control @if ($errors->has('certification_no')) is-invalid @endif"
                                               name="certification_no" id="certification_no"
                                               placeholder="Enter Certificate No" value="{{ old('certification_no') }}"
                                               required>
                                        @error('certification_no')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('certification_no') }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                </div>

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
                                        <label>Started Year <span class="required-star">*</span></label>
                                        <input id="started_year" type="number"
                                               class="form-control @if ($errors->has('started_year')) is-invalid @endif"
                                               placeholder="Enter Started Year" name="started_year" required>
                                        @if ($errors->has('started_year'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('started_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Ended year <span class="required-star">*</span></label>
                                        <input type="number" id="ended_year"
                                               class="form-control @if ($errors->has('ended_year')) is-invalid @endif"
                                               name="ended_year" placeholder="Enter Ended year " required>
                                        @if ($errors->has('ended_year'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ended_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>


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
                                </div>

                                <div class="row">
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
                                    <div class="form-group col-md-6">
                                        <label>CGPA <span class="required-star">*</span></label>
                                        <input id="cgpq" type="number" step="0.01"
                                               class="form-control @if ($errors->has('cgpq')) is-invalid @endif"
                                               placeholder="Enter CGPS" name="cgpq" required>
                                        @if ($errors->has('cgpq'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cgpq') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Result Notification No <span class="required-star">*</span></label>
                                        <input type="text" id="result_notification_no"
                                               class="form-control @if ($errors->has('result_notification_no')) is-invalid @endif"
                                               name="result_notification_no" placeholder="Enter Result Notification No " required>
                                        @if ($errors->has('result_notification_no'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('result_notification_no') }}</strong>
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
