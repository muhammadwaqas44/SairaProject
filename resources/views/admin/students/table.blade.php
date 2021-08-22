<table id="students_listing"
       class="table table-bordered table-striped display responsive nowrap" cellspacing="0"
       width="100%">
    @php
        $count = 1;
    @endphp
    <thead>
    <tr>
        <th style="width: 10px">Sr. No.</th>
        <th>Registration No</th>
        <th>Full Name</th>
        <th>Guardian Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Class</th>
        <th>Session</th>
        {{--                            <th style="width:120px;">Action</th>--}}
    </tr>
    </thead>
    <tbody>
    @php
        $count = ($students->currentPage()-1) *10;
    @endphp
    @foreach($students as $student)
        <tr id="student_{{$student->id}}">
            <td>{{$count+1 }}</td>
            <td>{{ $student->registration_no }}</td>
            <td>{{ $student->candidate_name }}</td>
            <td>{{ $student->guardian_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->class_name }}</td>
            <td>{{ \Carbon\Carbon::parse($student->started_date)->format('Y') }}-{{ \Carbon\Carbon::parse($student->ended_date)->format('Y') }}</td>
        </tr>
        @php
            $count++;
        @endphp
    @endforeach
    </tbody>
</table>
