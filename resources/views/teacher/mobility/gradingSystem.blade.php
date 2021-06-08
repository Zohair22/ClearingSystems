

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="display-5 text-center">{{ $collage->uni_name }}'s Grading System</h1>
        <div class="mt-3 text-center">
            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal">
                Add Grading system
            </button>
        </div>
        <div class="mt-3">
            <table class="table table-bordered table-striped table-success mt-3 m-auto w-75">
                <thead>
                <tr class="text-center">
                    <th scope="col" class="align-middle w-20">Grade</th>
                    <th scope="col" class="align-middle">From</th>
                    <th scope="col" class="align-middle">To</th>
                    <th scope="col" class="align-middle">####</th>
                </tr>
                </thead>
                <tbody>

                @foreach($collage->grades as $grade)
                    <tr class="text-center">
                        <td class="align-middle w-20">
                            {{ $grade->grade }}
                        </td>
                        <td class="align-middle">
                            {{ $grade->from }} %
                        </td>
                        <td class="align-middle">
                            {{ $grade->to }} %
                        </td>
                        <td class="align-middle w-15 p-0">
                            <a href="{{route('editCollageGrade',$grade->id)}}" class="btn btn-primary m-2">Update</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-lg">
        <div class="modal-content bg-success rounded-lg font-weight-bold">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Grading System') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group row my-2">
                    <form id="formGrade" class="m-0 p-0" action="{{ route('addNewCollageGrade') }}" method="post">
                        @csrf

                        <input type="text" hidden name="uni_id" value="{{ $collage->id }}">

                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]" value="A+" required>
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
                                    <input id="fromA*" type="text" class="form-control from form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
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
                                    <input id="toA*" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="A" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromA" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromA" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toA" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toA" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="A-" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromA-" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromA-" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toA-" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toA-" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="B+" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromB+" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromB+" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toB+" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toB+" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="B" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromB" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromB" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toB" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toB" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="B-" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromB-" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromB-" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toB-" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toB-" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="C+" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromC+" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromC+" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toC+" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toC+" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="C" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromC" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromC" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toC" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toC" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="C-" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromC-" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromC-" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toC-" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toC-" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]"  value="D+" required >
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromD+" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromD+" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toD+" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toD+" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" value="" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>


                        <div class="form-row mt-2 col-12">

                            <div class="form-group col d-inline-flex">
                                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade:') }}</label>
                                <div class="col-md-9">
                                    <input id="grade" type="text" class="form-control font-weight-bold text-center form-control-sm @error('grade') is-invalid @enderror" name="grade[]" value="D" required>
                                    @error('grade')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="fromD" class="col-md-3 text-left col-form-label py-0 ">{{ __('From:') }}</label>
                                <div class="col-md-9">
                                    <input id="fromD" type="text" class="form-control form-control-sm @error('from') is-invalid @enderror" name="from[]" value="" required>
                                    @error('from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col d-inline-flex">
                                <label for="toD" class="col-md-3 text-left col-form-label py-0 ">{{ __('To:') }}</label>
                                <div class="col-md-9">
                                    <input id="toD" type="text" class="form-control form-control-sm @error('to') is-invalid @enderror" name="to[]" required>
                                    @error('to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary ml-5">Add Grading System</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
