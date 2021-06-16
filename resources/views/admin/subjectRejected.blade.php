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
        <table class="table table-bordered table-striped table-success mt-3">
            <thead>
            <tr class="text-center">
                <th colspan="4" class="align-middle">Student Subject</th>
                <th colspan="4" class="align-middle">Collage Subject</th>
                <th scope="col" class="align-middle">#####</th>
            </tr>
            <tr class="text-center">
                <th scope="col" class="align-middle">Subject Description</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Grade</th>
                <th scope="col" class="align-middle">Percentage</th>
                <th scope="col" class="align-middle">Our subject</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Our Grade</th>
                <th scope="col" class="align-middle">Percentage</th>
                <th scope="col" class="align-middle">Status</th>
                @if(auth()->user()->group_by === '3')
                    <th scope="col" class="align-middle">######</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @if($student->confirmation)
                @foreach($student->confirmation->mobilities as $studentMobility)
                    @if($studentMobility->acceptable === 0)
                        <tr class="text-center">
                            <td class="p-2 align-middle" style="width: 30rem">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    <div class=" @if($loop->first) mb-3 @else mt-2 @endif">
                                        <div class="text-left font-weight-bold text-md">{{ $subjectMobility->subjects->name }} @if($subjectMobility->subjects->title === 1)CS @else IS @endif {{ $subjectMobility->subjects->code }} :</div>
                                        <div class="text-left ml-4"><p class="text-justify">{{ $subjectMobility->subjects->description }}</p></div>
                                    </div>
                                    @if($loop->last)
                                    @else
                                        <hr class="m-0">
                                    @endif
                                @endforeach
                            </td>

                            <td class="p-2  align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class="mt-5"></div>
                                    @endif
                                    <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->subjects->chr }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr class="mt-4">
                                    @endif
                                @endforeach
                            </td>

                            <td class="p-2  align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class="mt-5"></div>
                                    @endif
                                    <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->grade }}</p>
                                    @if($loop->last)
                                    @else
                                        <hr class="mt-4">
                                    @endif
                                @endforeach
                            </td>

                            <td class="p-2  align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class="mt-5"></div>
                                    @endif

                                    @foreach($student->collages->grades as $grade)
                                        @if($grade->grade === $subjectMobility->grade)
                                            <p class="py-5 font-weight-bold text-lg">{{ $grade->from }} - {{ $grade->to }}</p>
                                        @endif

                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="mt-4">
                                    @endif
                                @endforeach
                            </td>

                            <td class="p-2 align-middle" style="width: 30rem">
                                <div class="text-left font-weight-bold text-md">{{ $studentMobility->ours->name }} @if($studentMobility->ours->title === 1)CS @else IS @endif {{ $studentMobility->ours->code }} :</div>
                                <div class="text-left ml-4"><p class="text-justify">{{ $studentMobility->ours->description }}</p></div>
                            </td>

                            <td class="align-middle">
                                <p class="py-5 font-weight-bold text-lg">{{ $studentMobility->ours->chr }}</p>
                            </td>

                            <td class="p-2  align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class="mt-5"></div>
                                    @endif

                                    @foreach($ourGrades as $ourGrade)
                                        @if($ourGrade->grade === $subjectMobility->grade)
                                            <p class="py-5 font-weight-bold text-lg">{{ $ourGrade->grade }}</p>
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="mt-4">
                                    @endif
                                @endforeach
                            </td>

                            <td class="p-2  align-middle">
                                @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                    @if($loop->last)
                                        <div class="mt-5"></div>
                                    @endif

                                    @foreach($ourGrades as $ourGrade)
                                        @if($ourGrade->grade === $subjectMobility->grade)
                                            <p class="py-5 font-weight-bold text-lg">{{ $ourGrade->from }} - {{ $ourGrade->to }}</p>
                                        @endif
                                    @endforeach

                                    @if($loop->last)
                                    @else
                                        <hr class="mt-4">
                                    @endif
                                @endforeach
                            </td>

                            <td class="align-middle">
                                @if($studentMobility->acceptable === null)
                                    <div class="text-secondary text-md font-weight-bold">In Progress<br><span class="text-xs">{{ $studentMobility->updated_at->diffForHumans() }}</span></div>
                                @elseif($studentMobility->acceptable === 1)
                                    <div class="text-primary text-md font-weight-bold">Accepted<br><span class="text-xs">{{ $studentMobility->updated_at->diffForHumans() }}</span></div>
                                @elseif($studentMobility->acceptable === 0)
                                    <div class="text-danger text-md font-weight-bold">Refused<br><span class="text-xs">{{ $studentMobility->updated_at->diffForHumans() }}</span></div>
                                @endif
                            </td>

                            @if(auth()->user()->group_by === '3')
                                <td class="align-middle">
                                    <form action="{{ route('deleteStudentMobility',$studentMobility->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Remove Mobility</button>
                                    </form>
                                </td>
                            @endif
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
@endsection
