
@if(auth()->user()->group_by === '1')
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-3">
                <a href="{{route('addNewUserForm')}}" class="btn btn-outline-primary text-lg-center px-5">Add New User</a>
            </div>
            <div class="col-9">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h1 class="display-5 text-center">All Students</h1>

        <table class="table table-striped table-bordered border-2 border-success table-success mt-3 mx-auto">
            <thead>
            <tr class="font-weight-bold font-italic">
                <th scope="col">#</th>
                <th scope="col">Student Name</th>
                <th scope="col">Student Nationality</th>
                <th scope="col">Student Qualification</th>
                <th scope="col">Qualification Year</th>
                <th scope="col">Student Level</th>
                <th scope="col">Student Semester</th>
                <th scope="col">Student University</th>
                <th scope="col">Student Collage</th>
                <th scope="col" class="text-center">###</th>
            </tr>
            </thead>

            <tbody>
            @foreach($confirmations as $confirmation)
                <tr class="text-center">
                    <th>
                        @if($confirmation->confirmed === 0 or $confirmation->confirmed == null)
                            <p class="text-danger font-weight-bold text-lg"><i class="fas fa-exclamation-triangle"></i></p>
                        @else
                            <p class="text-primary"><i class="fas fa-check"></i></p>
                        @endif
                    </th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->name }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->nationality }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->qualification }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->qualification_year }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->level }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->semester }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->collages->uni_name }}</th>
                    <th scope="row" class="font-weight-light align-middle">{{ $confirmation->student->collages->collage }}</th>
                    <th scope="row" class="font-weight-light align-middle py-2">
                        <a href="{{ route('studentMobility',$confirmation->student->id) }}" class="btn btn-secondary btn-sm">View mobility</a>
                    </th>
                </tr>
            @endforeach
            @if($confirmations->count() === 0)
                <tr class="text-center">
                    <th colspan="10" class="font-weight-light align-middle py-2">
                        <p class="text-danger font-weight-bold p-3">Nothing to Show</p>
                    </th>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endif
