
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="mb-4">
            <h1 class="display-6"> <span class="font-weight-bold">University :</span> {{ $student->collages->uni_name }}</h1>
            <h1 class="display-6"> <span class="font-weight-bold">Collage :</span> {{ $student->collages->collage }}</h1>
            <h1 class="display-6"> <span class="font-weight-bold">Student :</span> {{ $student->name }}
                <a href="{{ route('studentMobility',$student->id) }}" class="btn btn-sm btn-outline-info font-weight-bold ml-5">
                    All Mobility of this Student
                </a>
            </h1>
        </div>

        <div class="row">
            <div class="col-3">
                <button type="button" class="btn btn-sm font-weight-bold btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Add Mobility For Student
                </button>
                <button type="button" class="btn btn-sm btn-outline-primary font-weight-bold mt-2" data-toggle="modal" data-target="#Subjects">
                    Add New Subject
                </button>
            </div>
            <div class="col-6">
                <h1 class="display-5">All Subjects for this Collage</h1>
            </div>
            <div class="col-3">
                <div class=" float-right">
                    <a href="{{ route('gradingSystem',$student->uni_id) }}" class="btn btn-sm font-weight-bold btn-primary">
                        Grading System
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <table class="table table-bordered table-striped table-success mt-3">
            <thead>
            <tr class="text-center">
                <th scope="col" class="align-middle">Subject Code</th>
                <th scope="col" class="align-middle">Subject Name</th>
                <th scope="col" class="align-middle">Credit Hour</th>
                <th scope="col" class="align-middle">Subject Description</th>
                <th scope="col" class="align-middle">#####</th>
            </tr>
            </thead>
            <tbody>
            @if($student->collages->subjects)
                @foreach($student->collages->subjects as $subject)
                    <tr class="text-center">
                        <td class="align-middle ">
                            @if($subject->title === 1)CS @else IS @endif {{ $subject->code }}
                        </td>

                        <td class="align-middle ">
                            <div class="m-0 mt-2" id="{{$subject->id}}"> {{ $subject->name }}</div>
                        </td>

                        <td class="align-middle ">
                            <div class="m-0 mt-2"> {{ $subject->chr }}</div>
                        </td>

                        <td class="align-middle max-w-3xl">
                            <div class="text-left ml-4 space-x-2"><p class="text-justify">{{ $subject->description }}</p></div>
                        </td>
                        <td class="align-middle w-10">
                            <div class="d-inline-flex">
                                <div>
                                    <a href="{{ route('editSubject',$subject->id) }}" class="btn text-md text-primary m-0 mr-1 p-0"><i class="far fa-edit"></i></a>
                                </div>
                                <div>
                                    <form action="{{ route('deleteSubject',$subject->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn text-md text-danger m-0 p-0"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                @endforeach
            @else
                <tr>
                    <td class="align-middle text-danger text-center" colspan="6">
                        {{$student->collages->uni_name}} University haven't any Subject yet.
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="staticBackdrop" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success rounded-lg font-weight-bold text-lg">
            <div class="modal-header py-1 my-2">
                <h5 class="modal-title font-weight-bold text-lg text-center display-6" id="exampleModalLongTitle">New Mobility</h5>
            </div>
            <div class="modal-body">
                @include('teacher.mobility.mobilityForm')
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="Subjects" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success rounded-lg font-weight-bold text-lg">
            <div class="modal-header py-1 my-2">
                <h5 class="modal-title font-weight-bold text-lg text-center display-6" id="exampleModalLongTitle">New Subject</h5>
            </div>
            <div class="modal-body">
                @include('teacher.mobility.newSubjects')
            </div>
        </div>
    </div>
</div>
