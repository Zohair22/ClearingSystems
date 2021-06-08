

@if(auth()->user()->group_by === '3')
    <div class="col-md-2">
        @include('teacher.leftSideBar')
    </div>

    <div class="col-md-9">

        <div class="card-rounded bg-success font-weight-bold">
            <div class="card-header p-2">
                <div class="text-light text-sm font-weight-bold align-content-center px-5">
                    <div class="float-left">
                        <button type="button" class="btn btn-primary p-1 px-3 rounded-lg" data-toggle="modal" data-target="#newCollage">
                            Add new Collage
                        </button>
                    </div>
                    <div class="float-right text-md text-dark">
                        Add new Student
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="modal-body py-0" >
                    @include('teacher.student.addStudentInfo')
                </div>
            </div>
        </div>

    </div>
@endif

<!-- Modal -->
<div class="modal fade bd-example-modal-lg text-dark" tabindex="-1" role="dialog" id="newCollage" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success rounded-lg font-weight-bold text-lg">
            <div class="modal-header py-1 my-2">
                <h5 class="modal-title font-weight-bold text-lg display-6" id="exampleModalLongTitle">Add new University</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('teacher.collage')
            </div>

        </div>
    </div>
</div>

