


<form action="{{route('addNewCollage')}}" method="POST">
    @csrf

    <div class="form-group row my-2">
        <label for="uni_name" class="col-md-3 text-left col-form-label py-0 ">{{ __('University Name') }}</label>
        <div class="col-md-9">
            <input id="uni_name" type="text" class="form-control form-control-sm @error('uni_email') is-invalid @enderror" name="uni_name" value="{{ old('uni_name') }}" required autofocus>
            @error('uni_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row my-2">
        <label for="collage" class="col-md-3 text-left col-form-label py-0 ">{{ __('Collage Name') }}</label>
        <div class="col-md-9">
            <input id="collage" type="text" class="form-control form-control-sm @error('collage') is-invalid @enderror" name="collage" value="{{ old('collage') }}" required>
            @error('collage')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>



    <div class="form-group my-2 mt-4">
        <div class="col-md-9 offset-md-1">
            <button type="submit" class="btn btn-primary p-1 px-3 rounded-lg">
                {{ __('Add New University') }}
            </button>
        </div>
    </div>
</form>
