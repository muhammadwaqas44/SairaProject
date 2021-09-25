<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body {
            width: 750px;
            margin: 0 auto;
            padding: 0;
            font-size: 15px;
        }

        .logo_right h2, .logo_right h3, .logo_right h4 {
            margin: 0 0 10px;
        }

        header {
            float: left;
            width: 100%;
            margin-bottom: 30px;
            margin-top: 20px;
        }

        .logo {
            float: left;
        }

        .logo img {
            width: 110px;
        }

        .logo_right {
            float: left;
            text-align: center;
            width: 76%;
            margin-top: 15px;
        }


        main {
            float: left;
            width: 100%;
            text-transform: uppercase;
        }

        main .right {
            float: left;
            width: 40%;
        }

        main .loop {
            float: left;
            width: 100%;
            font-weight: bold;
        }

        main .loop span {
            margin-left: 5px;
            text-decoration: underline;
        }


        main .left {
            float: left;
            width: 60%;
        }

        main .left .right_main {
            float: left;
            width: 70%;
        }

        main .left .img_lef {
            float: left;
            width: 30%;
        }

        main .left .img_lef img {
            width: 110px;
            height: 110px;
            object-fit: cover;
        }


    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="{{url('/').'/public/assets/ri_2.png'}}">
    </div>
    <div class="logo_right">
        <h2>MUHAMMAD NAWAZ SHAREEF</h2>
        <h3>University of Agriculture</h3>
        <h4>Multan</h4>
    </div>
</header>

<main>
    <div class="right">
        <div class="loop">name:<span>Muhammad Waqas</span></div>
        <div class="loop">father name:<span>Muhammad Ashfaq Anjum</span></div>
        <div class="loop">cnic<span>:32563-5184415-7</span></div>
        <div class="loop">batch no:<span>12</span></div>
        <div class="loop">date of birth:<span>24-nov-1992</span></div>
    </div>
    <div class="left">
        <div class="right_main">
            <div class="loop">name:<span>Muhammad Waqas</span></div>
            <div class="loop">father name:<span>Muhammad Ashfaq Anjum</span></div>
            <div class="loop">cnic<span>:32563-5184415-7</span></div>
            <div class="loop">batch no:<span>258</span></div>
            <div class="loop">date of birth:<span>24-nov-1992</span></div>
        </div>
        <div class="img_lef">
            <img src="{{url('/').'/public/assets/ri_2.png'}}" alt="">
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <div>
        <form id="getResultImages" enctype="multipart/form-data">
            @csrf
            <input name="id" type="hidden" value="a3a284c7-18ed-4b1f-abb3-26b954114d4e">
            <div class="form-group">
                <label for="file">Type</label>
                <select class="form-control" name="type" required>
                    <option value="certificate">Certificate</option>
                    <option value="transcript">Transcript</option>
                </select></div>
            <div class="form-group">
                <label for="file">Image File</label>
                <input type="file" class="form-control" id="file" name="check_image">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

    <hr>
    <div id="show_result">

    </div>
</main>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('public/front/jquery.blockUI.js') }}"></script>

<script>
    $('#getResultImages').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData($('#getResultImages')[0]);
        $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff',
            }
        });
        $.ajax({
            type: 'POST',
            url: "{{route('checkImageDetail')}}",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (response, status) {
                if (response.result == 'success') {
                    $.unblockUI();
                    Swal.fire(response.message)
                    var append_view = response.view_append;
                    $('#show_result').empty();
                    $('#show_result').html(append_view);

                } else if (response.result == 'error') {
                    $.unblockUI();
                    Swal.fire(response.message)
                }
            },
            error: function (data) {
                $.unblockUI();
                Swal.fire('Request No Submit.')

            }
        });
    });
</script>
</body>
</html>
