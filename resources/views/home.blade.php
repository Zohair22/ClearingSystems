@extends('layouts.app')

@section('content')

    @if(auth()->user()->group_by === '1')
        <div class="container">
            <div class="row justify-content-between">
                @include('admin.index')
            </div>
        </div>
    @endif

    @if(auth()->user()->group_by === '2')
        @include('doctor.index')
    @endif

    @if(auth()->user()->group_by === '3')
        <div class="container">
            <div class="row justify-content-between">
                @include('teacher.index')
            </div>
        </div>
    @endif

@endsection
