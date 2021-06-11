@extends('layouts.app')

@section('content')

    @if(auth()->user()->group_by === '1')
        @include('admin.index')
    @endif

    @if(auth()->user()->group_by === '2')
        @include('doctor.index')
    @endif

    @if(auth()->user()->group_by === '3')
        @include('teacher.index')
    @endif

@endsection
