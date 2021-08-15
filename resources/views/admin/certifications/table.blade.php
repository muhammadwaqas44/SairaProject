<table id="certifications_listing"
       class="table table-bordered table-striped display responsive nowrap" cellspacing="0"
       width="100%">
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
        {{--                            <th style="width:120px;">Action</th>--}}
    </tr>
    </thead>
    <tbody>
    @php
        $count = ($certifications->currentPage()-1) *10;
    @endphp
    @foreach($certifications as $certification)
        <tr id="certificate_{{$certification->id}}">
            <td>{{ $certification->id }}</td>
            <td>{{ $certification->registration_no }}</td>
            <td>{{ $certification->certification_no }}</td>
            <td>{{ $certification->candidate_name }}</td>
            <td>{{ $certification->guardian_name }}</td>
            <td>{{ $certification->class_name }}</td>
            <td>{{ $certification->started_year }}-{{ $certification->ended_year }}</td>
            <td>{{ $user->pdf_path }}</td>
        </tr>
        @php
            $count++;
        @endphp
    @endforeach
    </tbody>
</table>
