
<form method="POST" action="{{ route('addNewStudent') }}" class="text-md">
    @csrf

    <div class="form-group row my-2">
        <label for="name" class="col-md-3 text-left col-form-label py-0 ">{{ __('Student Name') }}</label>
        <div class="col-md-9">
            <input id="name" type="text" class="form-control form-control-sm form-control-sm @error('name') is-invalid @enderror" name="name" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="nationality" class="col-md-3 text-left col-form-label py-0 ">{{ __('Nationality') }}</label>
        <div class="col-md-9">
            <input id="nationality" type="text" class="form-control form-control-sm @error('nationality') is-invalid @enderror" name="nationality" required value="Egyptian">
            @error('nationality')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="qualification" class="col-md-3 text-left col-form-label py-0 ">{{ __('Qualification') }}</label>
        <div class="col-md-9">
            <input id="qualification" type="text" class="form-control form-control-sm @error('qualification') is-invalid @enderror" name="qualification" required>
            @error('qualification')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="qualification_year" class="col-md-3 text-left col-form-label py-0 ">{{ __('Qualification Year') }}</label>
        <div class="col-md-9">
            <input id="qualification_year" type="date" class="form-control form-control-sm @error('qualification_year') is-invalid @enderror" name="qualification_year" required>
            @error('qualification_year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="level" class="col-md-3 text-left col-form-label py-0 ">{{ __('Level') }}</label>
        <div class="col-md-9">
            <input id="level" type="text" class="form-control form-control-sm @error('level') is-invalid @enderror" name="level" required>
            @error('level')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="semester" class="col-md-3 text-left col-form-label py-0 ">{{ __('Semester') }}</label>
        <div class="col-md-9">
            <input id="semester" type="text" class="form-control form-control-sm @error('semester') is-invalid @enderror" name="semester" required>
            @error('semester')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row my-2">
        <label for="uni_id" class="col-md-3 text-left col-form-label py-0">{{ __('University') }}</label>
        <div class="col-md-9">
            <select class="form-select form-control form-control-sm " aria-label="Default select example" name="uni_id" id="uni_id" required>
                <option selected>Open this select menu</option>

                @foreach($collages as $collage)
                    <option value="{{ $collage->id }}">{{$collage->uni_name}} --- {{ $collage->collage }}</option>
                @endforeach
            </select>
            @error('uni_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>



    <div class="form-group row mt-3 mb-0">
        <div class="col-md-7 offset-md-1">
            <button type="submit" class="btn btn-primary p-1 px-3 rounded-lg">
                {{ __('Add New') }}
            </button>
        </div>
    </div>
</form>






