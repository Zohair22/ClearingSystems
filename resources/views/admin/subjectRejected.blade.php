@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1 class="display-6 font-weight-bold">Misr University for Science and Technology</h1>
            <h1 class="display-6 font-weight-bold">Collage: IT</h1>
        </div>
        <div class="text-lg w-70 ">
            <hr class="my-4">
            The committee decided after examining the detailed clearing of the student <strong>{{ $student->name }},</strong> who was transferred from the <strong>College {{ $student->collages->collage  }}</strong>
            <hr class="my-2">
            The equivalency of a total of
            <strong>
                @foreach($student->confirmation->mobilities as $studentMobility)
                    @if($studentMobility->acceptable === 1)
                        {{ $studentMobility->ours_id ? $studentMobility->ours->where('id',$studentMobility->ours_id)->sum('chr')  : 0  }}
                    @endif
                @endforeach
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
                <th scope="col" class="align-middle">Student Subject</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Grade</th>
                <th scope="col" class="align-middle">Percentage</th>
                <th scope="col" class="align-middle">Our subject</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Our Grade</th>
                <th scope="col" class="align-middle">Percentage</th>
            </tr>
            </thead>
            <tbody>
            @if($student->confirmation)
                @foreach($student->confirmation->mobilities as $studentMobility)
                    @if($studentMobility->acceptable === 0)
                        <tr class="text-center">
                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    <div class="">
                                        <div class="text-left font-weight-bold text-md">{{ $subjectMobility->subjects->name }} @if($subjectMobility->subjects->title === 1)CS @else IS @endif {{ $subjectMobility->subjects->code }}</div>
                                    </div>
                                    @if($loop->last)
                                    @else
                                        <hr class="m-0">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class=""></div>
                                    @endif
                                    <p class="font-weight-bold text-lg">{{ $subjectMobility->subjects->chr }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr class="">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class=""></div>
                                    @endif
                                    <p class="font-weight-bold text-lg">{{ $subjectMobility->grade }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr class="">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class=""></div>
                                    @endif

                                    @foreach($student->collages->grades as $grade)
                                        @if($grade->grade === $subjectMobility->grade)
                                            <p class="font-weight-bold text-lg">{{ $grade->from }} - {{ $grade->to }}</p>
                                        @endif

                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                <div class="text-left font-weight-bold text-md">{{ $studentMobility->ours->name }} @if($studentMobility->ours->title === 1)CS @else IS @endif {{ $studentMobility->ours->code }}</div>
                            </td>

                            <td class="align-middle">
                                <p class="font-weight-bold text-lg">{{ $studentMobility->ours->chr }}</p>
                            </td>

                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class=""></div>
                                    @endif

                                    @foreach($ourGrades as $ourGrade)
                                        @if($ourGrade->grade === $subjectMobility->grade)
                                            <p class="font-weight-bold text-lg">{{ $ourGrade->grade }}</p>
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class=""></div>
                                    @endif

                                    @foreach($ourGrades as $ourGrade)
                                        @if($ourGrade->grade === $subjectMobility->grade)
                                            <p class="font-weight-bold text-lg">{{ $ourGrade->from }} - {{ $ourGrade->to }}</p>
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="">
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @else
                        <tr class="text-center">
                            <td colspan="9" class="p-5 font-weight-bold text-danger align-middle">No Subject has been Rejected</td>
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
