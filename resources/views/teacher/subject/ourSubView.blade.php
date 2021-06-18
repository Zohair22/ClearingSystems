@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" data-toggle="modal" data-target="#subjectButton">
                    Add New Subject
                </button>
            </div>
            <div class="col-4"></div>
            <div class="col-4">
                <div class=" float-right">
                    <a href="{{ route('OurGrade')}}" class="btn btn-sm font-weight-bold btn-primary">
                        Grading System
                    </a>
                </div>
            </div>
        </div>
        @include('teacher.subject.ourSubject')

        <div>
            <table class="table table-bordered table-striped table-success mt-3">
                <thead>
                <tr class="text-center">
                    <th scope="col" class="align-middle">Subject Name</th>
                    <th scope="col" class="align-middle">Subject Code</th>
                    <th scope="col" class="align-middle">Credit Hours</th>
                    <th scope="col" class="align-middle">Description</th>
                    <th scope="col" class="align-middle">Doctor</th>
                    <th scope="col" class="align-middle">###</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr class="text-center">
                        <td class="align-middle">{{ $subject->name }}</td>

                        <td class="align-middle">
                            @if($subject->title === 1)
                                CS
                            @else
                                IS
                            @endif
                            {{ $subject->code }}
                        </td>

                        <td class="align-middle">{{ $subject->chr }} Hr</td>

                        <td class="align-middle">{{ $subject->description }}</td>

                        <td class="align-middle">{{ $subject->users->username}}</td>
                        <td class="align-middle w-10">
                            <div class="d-inline-flex">
                                <div>
                                    <a href="{{ route('editOurSubject',$subject->id) }}" class="btn text-md text-primary m-0 mr-1 p-0"><i class="far fa-edit"></i></a>
                                </div>
                                <div>
                                    <form action="{{ route('deleteOurSubject',$subject->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn text-md text-danger m-0 p-0"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
