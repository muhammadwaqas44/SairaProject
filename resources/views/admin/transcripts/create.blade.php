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
{{--                                        <div class="form-group col-md-5">--}}
{{--                                            <label>Attributes <span class="required-star">*</span></label>--}}

{{--                                            <input type="text" name="attribute[]" id="attribute"--}}
{{--                                                   class="form-control {{ $errors->has('attribute') ? ' is-invalid' : '' }}"--}}
{{--                                                   title="Select attribute" value="" required>--}}
{{--                                            @if($errors->has('attribute'))--}}
{{--                                                <span class="invalid-feedback" role="alert">--}}
{{--                                        {{ $errors->first('attribute') }}--}}
{{--                                    </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}

                                        <div align="left" class="mt-2 clearfixss">
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

    <script>
        var wrapper_pe = $(".append-div-attr"); //Fields wrapper
        var new_input_pe = $(".total-chq-c-pe").html();
        var add_button_p = $(".add_field_button");
        var HtmlEmle = '<div class="row">\n' +
            ' <div class="form-group col-md-5">\n' +
            ' <label>Attributes <span class="required-star">*</span></label>\n' +
            ' <input type="text" name="attribute[]" id="attribute" class="form-control {{ $errors->has('attribute') ? ' is-invalid' : '' }}"\n' +
            ' title="Select attribute" value="" required>\n' +
            ' @if($errors->has('attribute'))\n' +
            ' <span class="invalid-feedback" role="alert">\n' +
            ' {{ $errors->first('attribute') }}\n' +
            ' </span>\n' +
            ' @endif\n' +
            ' </div>\n' +
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
@endsection
