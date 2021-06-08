
@extends('layouts.app')

@section('content')


    <div class="container">
        <h3 class="display-5 font-weight-bold mb-5 text-center">Mobility of {{ $student->name }}</h3>

        <div class="container">
            <div class="float-left mb-3">
                <a href="{{ route('addSubjects',$student->id) }}" class="btn btn-sm font-weight-bold btn-primary">
                    Add New Mobility
                </a>
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <table class="table table-bordered table-striped table-success mt-3">
            <thead>
            <tr class="text-center">
                <th scope="col" class="align-middle">Subject Name</th>
                <th scope="col" class="align-middle">Grade</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Subject Description</th>
                <th scope="col" class="align-middle">Our subject</th>
                <th scope="col" class="align-middle">Status</th>
                <th scope="col" class="align-middle">######</th>
            </tr>
            </thead>
            <tbody>
            @if($student->confirmation)
                @foreach($student->confirmation->mobilities as $studentMobility)
                    <tr class="text-center">
                        <td class="align-middle">
                            @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->subjects->name }} <br> @if($subjectMobility->subjects->title === 1)CS @else IS @endif {{ $subjectMobility->subjects->code }}</p>
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
                                <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->subjects->chr }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2 align-middle" style="width: 30rem">
                            @foreach($studentMobility->subjectMobilities as $subjectMobility)
                                <div class="text-left font-weight-bold text-md">{{ $subjectMobility->subjects->name }} @if($subjectMobility->subjects->title === 1)CS @else IS @endif {{ $subjectMobility->subjects->code }} :</div>
                                <div class="text-left ml-2"><p class="text-justify">{{ $subjectMobility->subjects->description }}</p></div>
                                @if($loop->last)
                                @else
                                    <hr class="m-0">
                                @endif
                            @endforeach
                        </td>

                        <td class="align-middle">
                            <p class="font-weight-bold text-lg">{{ $studentMobility->ours->name }}
                                <br>
                                @if($studentMobility->ours->title === 1)CS @else IS @endif {{ $studentMobility->ours->code }}</p>
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
                        <td class="align-middle">
                            <form action="{{ route('deleteStudentMobility',$studentMobility->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove Mobility</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>


@endsection
