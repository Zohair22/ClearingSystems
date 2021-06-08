@extends('layouts.app')

@section('content')
    <div class="container text-lg">
        <div class="card-rounded bg-success col col-10 offset-1">
            <div class="card-header p-2">
                <div class="text-center text-sm align-content-center">
                    <h1 class="display-6 font-weight-bold text-center">Update Subject {{ $subject->name }}@if($subject->title === 1)
                            CS
                        @else
                            IS
                        @endif
                        {{ $subject->code }} Information
                    </h1>
                </div>
            </div>

            <div class="card-body">
                <div class="modal-body py-0" >

                    <form action="{{ route('updateOurSubject',$subject->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row my-2">
                            <label for="code" class="col-md-3 text-left col-form-label py-0">{{ __('Subject Code') }}</label>
                            <div class="col-md-9">
                                <input class="form-control form-control-sm  @error('code') is-invalid @enderror" name="code" value="{{ $subject->code }}" required>
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="title" class="col-md-3 text-left col-form-label py-0">{{ __('Subject Title') }}</label>
                            <div class="col-md-9">
                                <select class="form-select form-control form-control-sm  @error('title') is-invalid @enderror" name="title">
                                    <option value="1" @if($subject->title === 1) selected @endif>CS</option>
                                    <option value="2" @if($subject->title === 2) selected @endif>IS</option>
                                </select>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="name" class="col-md-3 text-left col-form-label py-0 ">{{ __('Subject Name') }}</label>
                            <div class="col-md-9">
                                <input class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" value="{{ $subject->name }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="description" class="col-md-3 text-left col-form-label py-0 ">{{ __('Description') }}</label>
                            <div class="col-md-9">
                                <textarea class="form-control form-control-sm  @error('description') is-invalid @enderror" name="description">{{ $subject->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="doctor" class="col-md-3 text-left col-form-label py-0 ">{{ __('Subject Admin') }}</label>

                            <div class="col-md-9">

                                <select class="form-select form-control form-control-sm  @error('doctor') is-invalid @enderror" name="doctor" required>
                                    <option>Select Doctor</option>
                                    @foreach($users as $user)
                                        @if($user->group_by != 3)
                                            <option value="{{ $user->id }}" @if($user->id === $subject->doctor) selected @endif >{{ $user->username }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('doctor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2 mb-2">
                            <div class="col-md-9 offset-md-1">
                                <button type="submit" class="btn btn-primary p-1 px-3 rounded-lg">
                                    {{ __('Update Subject') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        console.log('name')
    </script>
@endsection
