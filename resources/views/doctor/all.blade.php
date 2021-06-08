@extends('layouts.app')

@section('content')


    <div class="container-fluid">

        <h1 class="display-5 text-center">All Mobilities</h1>
        <table class="table table-striped table-bordered table-success mt-3 mx-auto">
            <thead>
            <tr class="text-center">
                <th scope="col" class="align-middle font-weight-bold p-2">Student's Subject</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Student's Grade</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Credit Hour</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Description</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Our subject</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Credit Hour</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Description</th>
                <th scope="col" class="align-middle font-weight-bold p-2">Status</th>
                <th scope="col" class="align-middle font-weight-bold p-2">######</th>
            </tr>
            </thead>


            @foreach($mobilities ?? '' as $mobility)

                @if(auth()->user()->id === $mobility->doctor)
                    <tr class="text-center">
                        <td class="p-2 align-middle">
                            @foreach($mobility->subjects as $subject)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subject->sub_name }} @if($subject->title === 1)CS @else IS @endif {{ $subject->code }}</p>
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
                                <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->grade }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif

                            @endforeach
                        </td>

                        <td class="p-2  align-middle">
                            @foreach($mobility->subjects as $subject)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subject->chr }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2 align-middle" style="width: 30rem">
                            @foreach($mobility->subjects as $subject)
                                <div class="text-left font-weight-bold text-md">{{ $subject->sub_name }} @if($subject->title === 1)CS @else IS @endif {{ $subject->code }} :</div>
                                <div class="text-left ml-2"><p class="text-justify">{{ $subject->description }}</p></div>
                                @if($loop->last)
                                @else
                                    <hr class="m-0">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2 align-middle">
                            <p class="font-weight-bold text-lg">{{ $mobility->ours->name }} @if($mobility->ours->title === 1)CS @else IS @endif {{ $mobility->ours->code }}</p>
                        </td>

                        <td class="p-2 align-middle">
                            <p class="font-weight-bold text-lg">{{ $mobility->ours->chr }}</p>
                        </td>

                        <td class="p-2 align-middle" style="width: 30rem">
                            <div class="text-left ml-2"><p class="text-justify"> {{ $mobility->ours->description }}</p></div>
                        </td>

                        <td class="align-middle">
                            @if($mobility->acceptable === null)
                                <div class="text-secondary font-weight-bold">In Progress<br>
                                    <span class="text-xs">
                                        {{ $mobility->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            @elseif($mobility->acceptable === 1)
                                <div class="text-primary font-weight-bold">Accepted<br>
                                    <span class="text-xs">
                                        {{ $mobility->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            @elseif($mobility->acceptable === 0)
                                <div class="text-danger font-weight-bold">Refused<br>
                                    <span class="text-xs">
                                        {{ $mobility->updated_at->diffForHumans() }}
                                    </span>
                                </div>
                            @endif
                        </td>

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
                                    <form action="{{ route('disapproveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger btn-sm text-md p-1">DisApprove</button>
                                    </form>
                                @elseif($mobility->acceptable === 0)
                                    <form action="{{ route('approveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-primary btn-sm text-md p-1">Approve</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection
