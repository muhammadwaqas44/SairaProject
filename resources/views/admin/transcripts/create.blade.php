@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid px-0">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transcripts</h1>
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
                            <h3 class="card-title">Add Transcript</h3>
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
                                <div class="append-div-attr mb-2">

                                    <div class="row">


                                        <div class="mt-2 clearfixss">
                                            <button type="button"
                                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 add_field_button mt-3">
                                                + Add
                                                Subject
                                            </button>
                                        </div>
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

@endsection
<script>
    var wrapper_pe = $(".append-div-attr"); //Fields wrapper
    var new_input_pe = $(".total-chq-c-pe").html();
    var add_button_p = $(".add_field_button");
    var HtmlEmle = '<div >\n' +
        '<div class="row">\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Course Id <span class="required-star">*</span></label>\n' +
        '<input id="course_id" type="text"\n' +
        'class="form-control @if ($errors->has('course_id')) is-invalid @endif"\n' +
        'placeholder="Enter Course Id" name="course_id" required>\n' +
        '@if ($errors->has('course_id'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('course_id') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Course Title <span class="required-star">*</span></label>\n' +
        '<input type="text" id="course_title"\n' +
        'class="form-control @if ($errors->has('course_title')) is-invalid @endif"\n' +
        'name="course_title" placeholder="Enter Course Title "\n' +
        'required>\n' +
        '@if ($errors->has('course_title'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('course_title') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '</div>\n' +
        '<div class="row">\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Credit Hour <span class="required-star">*</span></label>\n' +
        '<input id="credit_hour" type="text"\n' +
        'class="form-control @if ($errors->has('credit_hour')) is-invalid @endif"\n' +
        'placeholder="Enter Credit Hour" name="credit_hour" required>\n' +
        '@if ($errors->has('credit_hour'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('credit_hour') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Max Marks <span class="required-star">*</span></label>\n' +
        '<input type="text" id="max_marks"\n' +
        'class="form-control @if ($errors->has('max_marks')) is-invalid @endif"\n' +
        'name="max_marks" placeholder="Enter Max Marks "\n' +
        'required>\n' +
        '@if ($errors->has('max_marks'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('max_marks') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '</div>\n' +
        '<div class="row">\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Obtained Marks <span class="required-star">*</span></label>\n' +
        '<input id="obtained_marks" type="text"\n' +
        'class="form-control @if ($errors->has('obtained_marks')) is-invalid @endif"\n' +
        'placeholder="Enter Obtained Marks" name="obtained_marks" required>\n' +
        '@if ($errors->has('obtained_marks'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('obtained_marks') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Grade <span class="required-star">*</span></label>\n' +
        '<input type="text" id="grade"\n' +
        'class="form-control @if ($errors->has('grade')) is-invalid @endif"\n' +
        'name="grade" placeholder="Enter Grade "\n' +
        'required>\n' +
        '@if ($errors->has('grade'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('grade') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '</div>\n' +
        '<div class="row">\n' +
        '<div class="form-group col-md-6">\n' +
        '<label>Quantity Points <span class="required-star">*</span></label>\n' +
        '<input id="quantity_points" type="text"\n' +
        'class="form-control @if ($errors->has('quantity_points')) is-invalid @endif"\n' +
        'placeholder="Enter Quantity Points" name="quantity_points" required>\n' +
        '@if ($errors->has('quantity_points'))\n' +
        '<span class="invalid-feedback" role="alert">\n' +
        '<strong>{{ $errors->first('quantity_points') }}</strong>\n' +
        '</span>\n' +
        '@endif\n' +
        '</div>\n' +
        '</div>\n' +
    ' <div align="left" class="mt-3 clearfixss">\n' +
    ' <button type="button"\n' +
    ' class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 remove_fie mt-3">+ Remove\n' +
    ' </button>\n' +
    ' </div>\n' +
    ' </div>';
    $(add_button_p).click(function (e) { //on add input button click
        $(wrapper_pe).append(HtmlEmle); //add input box
    });
    $(wrapper_pe).on("click", ".remove_fie", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
    });
</script>
