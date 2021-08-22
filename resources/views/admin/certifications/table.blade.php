<table id="certifications_listing"
       class="table table-bordered table-striped display responsive nowrap" cellspacing="0"
       width="100%">
    @php
        $count = 1;
    @endphp
    <thead>
    <tr>
        <th style="width: 10px">Sr. No.</th>
        <th>Registration No</th>
        <th>Certification No</th>
        <th>Full Name</th>
        <th>Guardian Name</th>
        <th>Class</th>
        <th>Session</th>
        <th>Certificate</th>
    </tr>
    </thead>
    <tbody>
    @php
        $count = ($certifications->currentPage()-1) *10;
    @endphp
    @foreach($certifications as $certification)
        <tr id="certificate_{{$certification->id}}">
            <td>{{$count+1 }}</td>
            <td>{{ $certification->student->registration_no }}</td>
            <td>{{ $certification->certification_no }}</td>
            <td>{{ $certification->student->candidate_name }}</td>
            <td>{{ $certification->student->guardian_name }}</td>
            <td>{{ $certification->student->class_name }}</td>
            <td>{{ \Carbon\Carbon::parse($certification->student->started_date)->format('Y') }}-{{ \Carbon\Carbon::parse($certification->student->ended_date)->format('Y') }}</td>
            <td><a href="{{route('checkPdf',$certification->id)}}"><img src="{{$certification->pdf_image}}" style="width:100px"></a></td>
        </tr>
        @php
            $count++;
        @endphp
    @endforeach
    </tbody>
</table>
