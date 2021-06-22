

<div class="container-fluid">
    <h1 class="display-5 text-center">Mobilities</h1>
    <table class="table table-striped table-bordered table-success mt-3 mx-auto">
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
            <th scope="col" class="align-middle"  style="min-width: 8rem;max-width: 8rem">######</th>
        </tr>
        </thead>


        @foreach($mobilities as $mobility)
            @if(auth()->user()->id === $mobility->doctor && $mobility->acceptable === null)
                <tr class="text-center">
                    <td class="p-2 align-middle" style="max-width: 20rem">
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
                            @foreach($subjectMobility->student->collages->grades as $grade)
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

                    <td class="p-2 align-middle" style="max-width: 20rem">
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
                            @foreach($subjectMobility->student->collages->grades as $grade)
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

                            @foreach($subjectMobility->student->collages->grades as $grade)
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
                    <td class="align-middle p-0">
                        <div class="d-inline m-0 p-0">
                            <form action="{{ route('approveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="text-primary btn text-2xl font-weight-bold p-1"><i class="far fa-thumbs-up"></i></button>
                            </form>

                            <form action="{{ route('disapproveMobility',$mobility->id) }}" class="d-inline m-0 p-0 ml-3" method="post">
                                @csrf
                                @method('PATCH')
                                <button class="text-danger btn text-2xl font-weight-bold p-1"><i class="far fa-thumbs-down"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                </tbody>
            @endif
        @endforeach
    </table>
</div>
