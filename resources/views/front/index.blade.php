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
            margin-top: 15px;
            width: 130px;
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

        #preview {
            width: 100%;
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
    <video id="preview"></video>


</main>
<script type="text/javascript" src="{{asset('public/front/instascan.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('public/front/jquery.blockUI.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", event => {
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(cameras => {
            scanner.camera = cameras[cameras.length - 1];
            scanner.start();
        }).catch(e => console.error(e));

        scanner.addListener('scan', content => {
            console.log(content);
            checkQrCode(content)
        });
    });

    function checkQrCode(ele) {
        var qrcode_value = ele;
        var _token = "{{csrf_token()}}";
        var form = {
            _token: _token,
            'qrcode_value': qrcode_value,
        };
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
            url: "{{route('checkQrCode')}}",
            data: form,
            success: function (response, status) {
                if (response.result == 'success') {
                    $.unblockUI();
                    var url = "{{ url('student_details') }}"+'/'+response.data.id;
                    Swal.fire(response.message)
                    setTimeout(function () {
                        window.location.href = url;
                    }, 2000);
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
    }
</script>
</body>
</html>
