
<form method="POST" action="{{ route('addNewSubjectsss') }}" class="mb-0">
    @csrf
    <div class="form-group row my-1">
        <label for="code" class="col-md-3 text-left col-form-label py-0">{{ __('Subject Code') }} </label>
        <div class="col-md-9">
            <input class="form-control form-control-sm  @error('code') is-invalid @enderror" name="code" required>
            @error('code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="form-group row my-1">
        <label for="title" class="col-md-3 text-left col-form-label py-0">{{ __('Subject Title') }} </label>
        <div class="col-md-9">
            <select class="form-select form-control form-control-sm  @error('title') is-invalid @enderror" name="title">
                <option value="1">CS</option>
                <option value="2">IS</option>
            </select>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="form-group row my-1">
        <label for="name" class="col-md-3 text-left col-form-label py-0 ">{{ __('Subject Name') }} </label>
        <div class="col-md-9">
            <input class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="form-group row my-1">
        <label for="description" class="col-md-3 text-left col-form-label py-0 ">{{ __('Description') }} </label>
        <div class="col-md-9">
            <textarea class="form-control form-control-sm  @error('description') is-invalid @enderror" name="description"></textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <input name="uni_id" value="{{ $student->uni_id }}" hidden>

    <div class="form-group row my-1">
        <label for="chr" class="col-md-3 text-left col-form-label py-0">{{ __('Credit Hour') }} </label>
        <div class="col-md-9">

            <input type="text" class="form-control form-control-sm  @error('chr') is-invalid @enderror" name="chr" required>

            @error('chr')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mt-3 mb-0">
        <div class="col-md-9 offset-md-2 justify-content-between align-content-between">
            <div>
                <button type="submit" class="btn btn-primary p-1 px-3 rounded-lg">
                    {{ __('Add Subject') }}
                </button>
            </div>
        </div>
    </div>
</form>
