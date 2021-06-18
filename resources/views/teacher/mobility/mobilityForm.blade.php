
<div id="mobilityForm">
    <div class="mb-3">
        <button class="btn btn-sm btn-light bg-green-200 border p-1 px-5 rounded-lg" @click="add()">Two Subject</button>
        <button class="btn btn-sm btn-info bg-green-400 border p-1 px-5 rounded-lg" @click="mins()">One Subject</button>
    </div>
    <form method="POST" action="{{ route('addStudentSubjects') }}" class="mb-0">
        @csrf

        <div v-for="c in counters">
            <div class="form-group row my-1" >
                <label for="sub_id" class="col-md-3 text-left col-form-label py-0 ">{{ __('Subject') }}  @{{ c }} </label>
                <div class="col-md-9">
                    <select class="form-select form-control form-control-sm @error('sub_id') is-invalid @enderror" name="sub_id[]" required>
                        <option class="disabled">Select Subject @{{ c }}</option>
                        @foreach($student->collages->subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }} =-----> @if($subject->title === 1)CS @else IS @endif {{ $subject->code }}</option>
                        @endforeach
                    </select>
                    @error('sub_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row my-1">
                <label for="grade" class="col-md-3 text-left col-form-label py-0 ">{{ __('Grade') }} </label>
                <div class="col-md-9">
                    <input type="text" class="form-control form-control-sm  @error('grade') is-invalid @enderror" name="grade[]" required>
                    @error('grade')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

        </div>

        <input class="hide @error('stu_id') is-invalid @enderror" name="stu_id" value="{{ $student->id }}" hidden>
        @error('stu_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


        <div class="form-group row my-1" >
            <label for="ours_id" class="col-md-3 text-left col-form-label py-0 ">{{ __('Our Subjects') }} </label>
            <div class="col-md-9">
                <select class="form-select form-control form-control-sm @error('ours_id') is-invalid @enderror" name="ours_id" required>
                    <option class="disabled">Select Subject</option>
                    @foreach($ours as $our)
                        <option value="{{ $our->id }}">{{ $our->name }} =-----> @if($our->title === 1)CS @else IS @endif {{ $our->code }}</option>
                    @endforeach
                </select>
                @error('ours_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>


        <input type="text" hidden name="teacher" value="{{ auth()->user()->id }}">
        @error('teacher')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror


        <div class="form-group row my-1">
            <label for="doctor" class="col-md-3 text-left col-form-label py-0 ">{{ __('Doctor') }} </label>
            <div class="col-md-9">
                <select class="form-select form-control form-control-sm @error('doctor') is-invalid @enderror" name="doctor" required>
                    <option class="disabled" x-placement="Select Doctor">Select Doctor</option>
                    @foreach($users as $user)
                        @if($user->group_by == 2)
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


        <div class="form-group row mt-3 mb-0">
            <div class="col-md-9 offset-md-2 justify-content-between align-content-between">
                <div>
                    <button type="submit" class="btn btn-primary p-1 px-3 rounded-lg">
                        {{ __('Send Mobility') }}
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>


@section('script')
    <script>
        new Vue({
            el: '#mobilityForm',
            data() {
                return {
                    counters: 1,
                    show: true,
                }
            },
            methods: {
                add(){
                    this.counters = 2;
                },
                mins(){
                    this.counters = 1;
                },
            }
        })
    </script>
@endsection
