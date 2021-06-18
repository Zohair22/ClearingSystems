

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="subjectButton" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success rounded-lg font-weight-bold text-lg">
            <div class="modal-header py-1 my-2">
                <h5 class="modal-title font-weight-bold text-lg display-6" id="exampleModalLongTitle">Add new Subject</h5>
            </div>
            <div class="modal-body">

                <form action="{{ route('addNewOurSubject') }}" method="POST">
                    @csrf

                    <div class="form-group row my-2">
                        <label for="code" class="col-md-3 text-left col-form-label py-0">{{ __('Subject Code') }}</label>
                        <div class="col-md-9">
                            <input value="{{ old('code') }}" class="form-control form-control-sm  @error('code') is-invalid @enderror" name="code" required>
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
                            <select class="form-select form-control form-control-sm" name="title">
                                <option value="1">CS</option>
                                <option value="2">IS</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row my-2">
                        <label for="name" class="col-md-3 text-left col-form-label py-0 ">{{ __('Subject Name') }}</label>
                        <div class="col-md-9">
                            <input value="{{ old('name') }}" class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-2">
                        <label for="chr" class="col-md-3 text-left col-form-label py-0 ">{{ __('Credit Hours') }}</label>
                        <div class="col-md-9">
                            <input value="3" class="form-control form-control-sm  @error('chr') is-invalid @enderror" name="chr" required>
                            @error('chr')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row my-2">
                        <label for="description" class="col-md-3 text-left col-form-label py-0 ">{{ __('Description') }}</label>
                        <div class="col-md-9">
                            <textarea class="form-control form-control-sm  @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
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
                                    @if($user->group_by === '2')
                                        <option value="{{ $user->id }}">{{ $user->username }}</option>
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
                            <button type="submit" class="btn btn-sm font-weight-bold btn-primary p-1 px-3 rounded-lg">
                                {{ __('Add New Subject') }}
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
