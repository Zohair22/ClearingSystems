
@extends('layouts.app')

@section('content')
    @if(auth()->user()->group_by === '1')
        <div class="container-fluid mb-2 row ml-1">
            <div class="col-6">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Name:</strong> {{ $student->name }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Qualification:</strong> {{ $student->qualification }}</h1>
                <hr class="my-1">
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Degree:</strong> {{ $student->grade }}</h1>
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
                <h1 class="display-7"><strong class="ml-3 mr-4">Student Percentage:</strong> {{ $student->percentage }}%</h1>
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
                        Add New Subject for student mobility
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
                            @foreach($student->confirmation->mobilities as $mobility)
                            @if($mobility->acceptable === null) disabled @endif
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
                @foreach($student->confirmation->mobilities as $mobility)
                    <tr class="text-center">
                        <td class="p-2 align-middle" style="width: 30rem">
                            @foreach($mobility->subjectMobilities as $subjectMobility)
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
                            @foreach($mobility->subjectMobilities as $subjectMobility)
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
                            @foreach($mobility->subjectMobilities as $subjectMobility)
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
                            @foreach($mobility->subjectMobilities as $subjectMobility)
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
                            <div class="text-left font-weight-bold text-md">{{ $mobility->ours->name }} @if($mobility->ours->title === 1)CS @else IS @endif {{ $mobility->ours->code }} :</div>
                            <div class="text-left ml-4"><p class="text-justify">{{ $mobility->ours->description }}</p></div>
                        </td>

                        <td class="align-middle">
                            <p class="py-5 font-weight-bold text-lg">{{ $mobility->ours->chr }}</p>
                        </td>

                        <td class="p-2  align-middle">
                            @foreach($mobility->subjectMobilities as $subjectMobility)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                @foreach($student->collages->grades as $grade)
                                    @if($subjectMobility->grade === $grade->grade)
                                        @foreach($ourGrades as $ourGrade)
                                            @if(in_array($grade->from, range($ourGrade->from,$ourGrade->to),true))
                                                <p class="py-5 font-weight-bold text-lg">{{ $ourGrade->grade }}</p>
                                            @elseif($grade->from < 60)
                                                    <p class="py-5 font-weight-bold text-lg text-danger">F</p>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2  align-middle">
                            @foreach($mobility->subjectMobilities as $subjectMobility)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif

                                @foreach($student->collages->grades as $grade)
                                    @if($subjectMobility->grade === $grade->grade)
                                        @foreach($ourGrades as $ourGrade)
                                            @if(in_array($grade->from, range($ourGrade->from,$ourGrade->to),true))
                                                <p class="py-5 font-weight-bold text-lg">{{ $ourGrade->from }} - {{ $ourGrade->to }}</p>
                                            @elseif($grade->from < 60)
                                                    <p class="py-5 font-weight-bold text-lg text-danger">Failed</p>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif
                            @endforeach
                        </td>

                        <td class="align-middle">
                            @if($mobility->acceptable === null)
                                <div class="text-secondary text-md font-weight-bold">In Progress<br><span class="text-xs">{{ $mobility->updated_at->diffForHumans() }}</span></div>
                            @elseif($mobility->acceptable === 1)
                                <div class="text-primary text-md font-weight-bold">Accepted<br><span class="text-xs">{{ $mobility->updated_at->diffForHumans() }}</span></div>
                            @elseif($mobility->acceptable === 0)
                                <div class="text-danger text-md font-weight-bold">Refused<br><span class="text-xs">{{ $mobility->updated_at->diffForHumans() }}</span></div>
                            @endif
                        </td>

                        @if(auth()->user()->group_by === '3')
                            <td class="align-middle">
                                <form action="{{ route('deleteStudentMobility',$mobility->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remove Mobility</button>
                                </form>
                            </td>
                        @elseif(auth()->user()->group_by === '1')
                            <td class="align-middle p-2">
                                <div>
                                    @if($mobility->acceptable === null)
                                        <div>
                                            <form action="{{ route('approveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-primary btn-sm text-md p-1">Approve</button>
                                            </form>
                                        </div>
                                        <div class=" mt-5 ">
                                            <form action="{{ route('disapproveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button class="btn btn-danger btn-sm text-md p-1">DisApprove</button>
                                            </form>
                                        </div>
                                    @elseif($mobility->acceptable === 1)
                                    <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm text-md p-1" data-toggle="modal" data-target="#exampleModal" @if($student->confirmation->confirmed === 1) disabled @endif >
                                            DisApprove
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Reason Why?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('disapproveMobility',$mobility->id) }}" class="d-inline m-0 p-0 ml-3" method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-group row">
                                                                <label for="reason" class="col-md-4 col-form-label text-lg">{{ __('Reason Why?') }}</label>

                                                                <div class="col-md-6">
                                                                    <textarea id="reason" class="form-control @error('reason') is-invalid @enderror" name="reason" autofocus>{{ old('reason') }}</textarea>

                                                                    @error('reason')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-danger text-xl px-5">Refused</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($mobility->acceptable === 0)
                                        <form action="{{ route('approveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
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
