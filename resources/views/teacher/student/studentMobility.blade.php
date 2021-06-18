
@extends('layouts.app')

@section('content')
    @if(auth()->user()->group_by === '1')
        <div class="container-fluid mb-2 row ml-1">
            <div class="col-6">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Name:</strong> {{ $student->name }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Qualification:</strong> {{ $student->qualification }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Degree:</strong> {{ $student->degree }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student University:</strong> {{ $student->collages->uni_name }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Collage:</strong> {{ $student->collages->collage }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Level:</strong> {{ $student->level }} --- <strong>Semester: </strong>{{ $student->semester }}</h1>
                <hr class="my-1">
            </div>
            <div class="col-6">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Nationality:</strong> {{ $student->nationality }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Qualification Year:</strong> {{ $student->qualification_year }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Percentage:</strong> {{ $student->percentage }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Mobilization to:</strong> MUST University</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Collage:</strong> IT</h1>
                <hr class="my-1">
            </div>
        </div>
    @endif
    <div class="container text-center">
        @if(auth()->user()->group_by === '3')
            <h3 class="display-5 font-weight-bold mb-3 text-center">Mobility of {{ $student->name }}</h3>
            <div class="container">
                <div class="float-left mb-3">
                    <a href="{{ route('addSubjects',$student->id) }}" class="btn btn-sm font-weight-bold btn-primary">
                        Add New Mobility
                    </a>
                </div>
            </div>
        @elseif(auth()->user()->group_by === '1')

            @if($student->confirmation->confirmed != 1)
            <form method="post" action="{{ route('confirmation', $student->confirmation->id) }}">
                @csrf
                @method('PATCH')
                <input type="text" name="stu_id" hidden value="{{ $student->id }}">
                <input type="text" name="admin" hidden value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-success"
                        @foreach($student->confirmation->mobilities as $studentMobility)
                        @if($studentMobility->acceptable === null) disabled @endif
                    @break
                    @endforeach
                >@if($student->confirmation->confirmed === 1) Student Mobility Confirmed @else Confirm Student Mobility @endif</button>
            </form>
            @else
                <a href="{{ route('subjectAccepted',$student->id) }}" class="btn btn-primary mr-5">Subject Accepted</a>
                <a href="{{ route('subjectRejected',$student->id) }}" class="btn btn-info ml-5">Subject Rejected</a>
            @endif
        @endif
    </div>
    <div class="container-fluid">
        <table class="table table-bordered table-striped table-success mt-3">
            <thead>
            <tr class="text-center">
                <th colspan="4" class="align-middle">Student Subject</th>
                <th colspan="4" class="align-middle">Collage Subject</th>
                <th colspan="2" class="align-middle">Status</th>
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
                    <th scope="col" class="align-middle">######</th>
            </tr>
            </thead>
            <tbody>
            @if($student->confirmation)
                @foreach($student->confirmation->mobilities as $studentMobility)
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
                        @elseif(auth()->user()->group_by === '1')
                            <td class="align-middle p-2">
                                <div>
                                    @if($studentMobility->acceptable === null)
                                        <div>
                                            <form action="{{ route('approveMobility',$studentMobility->id) }}" class="d-inline m-0 p-0" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-primary btn-sm text-md p-1">Approve</button>
                                            </form>
                                        </div>
                                        <div class=" mt-5 ">
                                            <form action="{{ route('disapproveMobility',$studentMobility->id) }}" class="d-inline m-0 p-0" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-danger btn-sm text-md p-1">DisApprove</button>
                                            </form>
                                        </div>
                                    @elseif($studentMobility->acceptable === 1)
                                        <form action="{{ route('disapproveMobility',$studentMobility->id) }}" class="d-inline m-0 p-0" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm text-md p-1"  @if($student->confirmation->confirmed === 1) disabled @endif >DisApprove</button>
                                        </form>
                                    @elseif($studentMobility->acceptable === 0)
                                        <form action="{{ route('approveMobility',$studentMobility->id) }}" class="d-inline m-0 p-0" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-primary btn-sm text-md p-1"  @if($student->confirmation->confirmed === 1) disabled @endif >Approve</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
