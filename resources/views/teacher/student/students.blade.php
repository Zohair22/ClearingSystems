@extends('layouts.app')

@section('content')


    <div class="container">
        <h1 class="text-center display-5 mb-4">Students Information</h1>
        <table class="table border table-bordered table-striped table-success text-center">
            <thead>
            <tr class="font-weight-bold font-italic">
                <th class="align-middle" scope="col">Student Name</th>
                <th class="align-middle" scope="col">Student Nationality</th>
                <th class="align-middle" scope="col">Student Qualification</th>
                <th class="align-middle" scope="col">Qualification Year</th>
                <th class="align-middle" scope="col">Student Level</th>
                <th class="align-middle" scope="col">Student Semester</th>
                <th class="align-middle" scope="col">Student University</th>
                <th class="align-middle" scope="col">Student Collage</th>
                <th class="align-middle" scope="col">###</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->name }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->nationality }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->qualification }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->qualification_year }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->level }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->semester }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->collages->uni_name }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $student->collages->collage }}</th>
                    <th scope="row" class="font-weight-light align-middle py-2">
                        <a href="{{ route('studentMobility',$student->id) }}" class="btn btn-secondary btn-sm mb-2">View mobility</a><br>
                        <div class="d-inline-flex justify-content-between row">
                            <div>
                                <a href="{{ route('editStudent',$student->id) }}" class="btn btn-info btn-sm mr-4"><i class="far fa-edit"></i></a>
                            </div>
                            <div>
                                <form action="{{ route('removeStudent',$student->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
