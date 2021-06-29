@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="ml-5">
            <h1 class="display-6 font-weight-bold" style="font-family: 'Roboto Mono', monospace; ">Misr University for Science and Technology</h1>
            <h1 class="display-6 font-weight-bold" style="font-family: 'Roboto Mono', monospace; ">Collage: Information Technology</h1>
        </div>
        <div class="text-lg w-70 ml-5">
            <hr class="my-4">

            <div class="text-center mb-4"><h1 class="display-6 text-success font-weight-bold">The Subjects is Accepted</h1></div>
            The committee decided after examining the detailed clearing of the student
            <strong style="font-family: 'Roboto Mono', monospace;">{{ $student->name }},</strong>
            who was transferred from the
            <strong style="font-family: 'Roboto Mono', monospace;">College {{ $student->collages->collage }}</strong>
            <hr class="my-2">
            The equivalency of a total of
            <strong>
                {{ $student->hours($student->confirmation->id) }}
                credit hours
            </strong>
            from the courses that the student has previously studied successfully in the entity from which he is transferred, and their data are as follows:-
        </div>
    </div>
    <div class="container-fluid">
        <table class="table table-bordered border-2 border-success table-striped table-success mt-3">
            <thead>
            <tr class="text-center">
                <th colspan="4" class="align-middle">Student Subject</th>
                <th colspan="4" class="align-middle">Collage Subject</th>
            </tr>
            <tr class="text-center">
                <th scope="col" class="align-middle py-3">Student Subject</th>
                <th scope="col" class="align-middle py-3">Credit Hour</th>
                <th scope="col" class="align-middle py-3">Grade</th>
                <th scope="col" class="align-middle py-3">Percentage</th>
                <th scope="col" class="align-middle py-3">Our subject</th>
                <th scope="col" class="align-middle py-3">Credit Hour</th>
                <th scope="col" class="align-middle py-3">Our Grade</th>
                <th scope="col" class="align-middle py-3">Percentage</th>
            </tr>
            </thead>
            <tbody>
            @if($student->confirmation)
                @foreach($student->confirmation->mobilities as $studentMobility)
                    @if($studentMobility->acceptable === 1)
                        <tr class="text-center">
                            <td class="align-middle p-4">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    <div class="">
                                        <div class="font-weight-bold text-md">{{ $subjectMobility->subjects->name }} @if($subjectMobility->subjects->title === 1)CS @else IS @endif {{ $subjectMobility->subjects->code }}</div>
                                    </div>
                                    @if($loop->last)
                                    @else
                                        <hr class="m-0">
                                    @endif
                                @endforeach
                            </td>

                            <td class=" align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div></div>
                                    @endif
                                        <p class="font-weight-bold text-lg">{{ $subjectMobility->subjects->chr }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr>
                                    @endif
                                @endforeach
                            </td>

                            <td class=" align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div></div>
                                    @endif
                                    <p class="font-weight-bold text-lg">{{ $subjectMobility->grade }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr>
                                    @endif
                                @endforeach
                            </td>

                            <td class=" align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div></div>
                                    @endif
                                    @foreach($student->collages->grades as $grade)
                                        @if($grade->grade === $subjectMobility->grade)
                                            <p class="font-weight-bold text-lg">{{ $grade->from }} - {{ $grade->to }}</p>
                                        @endif
                                    @endforeach
                                    @if($loop->last)
                                    @else
                                        <hr>
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                <div class="font-weight-bold text-md">{{ $studentMobility->ours->name }} @if($studentMobility->ours->title === 1)CS @else IS @endif {{ $studentMobility->ours->code }}</div>
                            </td>

                            <td class="align-middle">
                                <p class="font-weight-bold text-lg">{{ $studentMobility->ours->chr }}</p>
                            </td>

                            <td class=" align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div></div>
                                    @endif
                                    @foreach($student->collages->grades as $grade)
                                        @if($subjectMobility->grade === $grade->grade)
                                            @foreach($ourGrades as $ourGrade)
                                                @if(in_array($grade->from, range($ourGrade->from,$ourGrade->to),true))
                                                    <p class="font-weight-bold text-lg">{{ $ourGrade->grade }}</p>
                                                @elseif($grade->from < 60)
                                                    <p class="font-weight-bold text-lg">F</p>
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr>
                                    @endif
                                @endforeach
                            </td>

                            <td class=" align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div></div>
                                    @endif

                                    @foreach($student->collages->grades as $grade)
                                        @if($subjectMobility->grade === $grade->grade)
                                            @foreach($ourGrades as $ourGrade)
                                                @if(in_array($grade->from, range($ourGrade->from,$ourGrade->to),true))
                                                    <p class="font-weight-bold text-lg">{{ $ourGrade->from }} - {{ $ourGrade->to }}</p>
                                                @elseif($grade->from < 60)
                                                    <p class="font-weight-bold text-lg">Failed</p>
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="container row text-center mt-3 mb-40 p-2">
        <div class="font-weight-bold text-lg col-4">Clearing committee </div>
        <div class="font-weight-bold text-lg col-4">Dean of the College</div>
        <div class="font-weight-bold text-lg col-4">University's president</div>
    </div>
@endsection
