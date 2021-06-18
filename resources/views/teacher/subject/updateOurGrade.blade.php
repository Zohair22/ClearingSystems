

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card rounded-lg">
            <div class="card-body  bg-success rounded-lg font-weight-bold">
                <form id="formOurGrade" class="m-0 p-0" action="{{ route('updateGrade',$grade->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="form-row mt-2 col-12">

                        <div class="form-group col d-inline-flex">
                            <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                            <div class="col-md-9">
                                <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade" value="{{ $grade->grade }}" required>
                                @error('grade')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col d-inline-flex">
                            <label for="fromA*" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                            <div class="col-md-9">
                                <input id="fromA*" type="text" class="form-control from form-control-sm @error('from') is-invalid @enderror" name="from" value="{{ $grade->from }}" required>
                                @error('from')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col d-inline-flex">
                            <label for="toA*" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                            <div class="col-md-9">
                                <input id="toA*" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to" value="{{ $grade->to }}" required>
                                @error('to')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mb-0">Update Grading System</button>
                </form>
            </div>
        </div>
    </div>
@endsection
