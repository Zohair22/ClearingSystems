

@if(auth()->user()->group_by === '1')
    <div class="col-md-3">
        <a href="{{route('addNewUserForm')}}" class="text-decoration-none text-lg-center text-xl">Add New User</a>
    </div>
@endif
