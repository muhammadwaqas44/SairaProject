<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<style type="text/css">
    .header {
        padding-right: 5px;
        padding-left: 5px;
    }

    .top-left {
        width: 43%;
        float: left;
    }

    .top-right {
        width: 43%;
        float: left;
        text-align: right;
    }

    h5 {
        display: inline;
    }

    span {
        text-decoration: underline;
    }

    .logo {
        text-align: center;
        align-content: center;
    }

    .logo img {
        margin-left: 40%;
        margin-right: auto;
        display: block;
        width: 150px;
    }

    .headings {
        text-align: center;
        font-family: arial;
    }

    .headings h4 {
        text-transform: uppercase;

    }

    input {
        border: none;
        border-bottom: solid black 1px;
        width: 80%;
        font-size: 12pt;
        text-align: center;
    }

    input .fh {
        border: none;
        border-bottom: solid black 1px;
        width: 50%;
    }

    label {
        font-size: 12pt;
        text-align: justify;

    }

    .pageBody {
        padding: 5px;
    }

    .footer {
        padding: 5px;
    }

    .clearfix {
        margin-top: 400px;
        overflow: auto;
        clear: both;

    }
</style>
<body>

<div class="header">
    <div class="top-header">
        <div class="top-left">
            <h5>Registeration No:</h5><br>
            <span>{{$registration_no}}</span>
        </div>
        <div class="top-right">
            <h5>No.</h5>
            <span>{{$certification_no}}</span>
            <br>
            <h5>Date:</h5>
            <span>{{$header_date}}</span>
        </div>
    </div>


    <div class="logoHeader">
        <div class="logo">
            <img src="{{url('/').'/public/assets/MNSUAM-Logo.png'}}">
        </div>

        <div class="headings clearfix" >
            <h4>Muhammad Nawaz Shareef</h4>
            <h3>University of Agriculture, Multan</h3>
        </div>
    </div>
</div>
<br>
<div class="headings">
    <h5><b>Provisonal Certificate<b></h5>
</div>
<div class="pageBody">
    <br>
    <br>
    <div>
        <label>Candidate that:</label>
        <input type="text" name="name" value="{{$candidate_name}}">
    </div>

    <br>
    <div>
        <label>Son/Daughter of:</label>
        <input type="text" name="father" value="{{$guardian_name}}">
    </div>

    <br>
    <div>
        <label>Passed the:</label>
        <input type="text" name="degree" style="width: 88%;" value="{{$class_name}}">
    </div>

    <br>
    <div>
        <label style="text-align:justify;">Examination of Muhammad Nawaz Shareef University of Agriculture Multan Held
            during the<br><br>Year:</label>
        <input type="text" name="year" style="width: 40%;" value="{{$ended_year}}">
        <label>Session :</label>
        <input type="text" name="session" style="width: 40%;" value="{{$started_year}}-{{$ended_year}}">
    </div>

    <br>
    <div>
        <label>
            With Aggregate Marks/ % :
        </label>
        <input type="text" name="marks" style="width: 70%;"
               value="{{$obtain_marks}}/{{$total_marks}}({{$marks_percentage}}%)">
    </div>

    <br>
    <div>
        <label>
            Securing CGPA :
        </label>
        <input type="text" name="cgpa" style="width: 84%;" value="{{$cgpq}}/4.00">
    </div>


    <br>
    <br>
    <div style="float:right; text-align: center;">
        <br><br>
        <h4 style="margin-right: 200px">Controller of Examination <br>
            MNS University of Agriculture<br>Multan</h4>
        <img src="{{$qr_code}}" style="width: 200px;margin-left: 50px">


    </div>

</div>


<br>
<br>
<br>
<div class="footer">
    <div>
        <label style="font-size:10pt;">
            Result Notified vide No :
        </label>
        <input type="text" name="resultno" style="width: 10%;" value="{{$result_notification_no}}">
        <br>
        <br>
    </div>

    <div>
        <label style="font-size:10pt;">
            Dated:
        </label>
        <input type="text" name="date" style="width: 10%;" value="{{$footer_date}}">
    </div>
</div>

<script>
    // window.print();
</script>
</body>
</html>
