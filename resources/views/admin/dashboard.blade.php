<!-- @extends('layouts.admin') -->

@section('content')
<div class="wrapper">

    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid px-0">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4>{{ $studentCount }} </h4>

                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="fab fa-product-hunt"></i>
                        </div>
{{--                        <a href="{{ route('listProducts') }}" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>


                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>{{ $certificateCount }} </h4>

                            <p>Total Certificates</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
{{--                        <a href="{{ route('listUsers') }}" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4>{{ $transcriptCount }} </h4>

                            <p>Total Transcripts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
{{--                        <a href="{{ route('listBookings') }}" class="small-box-footer">More info <i--}}
{{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>
                <!-- ./col -->


            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



@endsection

@section('scripts')
<script>
    var success = "{{ session('success') }}"
    if (success.length) {
        toastr.success(success);
    }

</script>
@endsection
