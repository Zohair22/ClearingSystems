

<div class="container-fluid">

    <h1 class="display-5 text-center">Mobilities</h1>
    <table class="table table-striped table-bordered table-success mt-3 mx-auto">
        <thead>
        <tr class="text-center">
            <th scope="col" class="align-middle font-weight-bold p-2">Student's Subject</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Student's Grade</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Credit Hour</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Description</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Our Subject</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Credit Hour</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Description</th>
            <th scope="col" class="align-middle font-weight-bold p-2">Status</th>
        </tr>
        </thead>


        @foreach($mobilities ?? '' as $mobility)

            @if(auth()->user()->id === $mobility->doctor)
                @if($mobility->acceptable === null)
                    <tr class="text-center">
                        <td class="p-2 align-middle">
                            @foreach($mobility->subjects as $subject)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subject->sub_name }}<br> @if($subject->title === 1)CS @else IS @endif {{ $subject->code }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="m-0">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2  align-middle">
                            @foreach($mobility->subjectMobilities as $subjectMobility)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subjectMobility->grade }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif

                            @endforeach
                        </td>

                        <td class="p-2  align-middle">
                            @foreach($mobility->subjects as $subject)
                                @if($loop->last)
                                    <div class="mt-5"></div>
                                @endif
                                <p class="py-5 font-weight-bold text-lg">{{ $subject->chr }}</p>
                                @if($loop->last)
                                @else
                                    <hr class="mt-4">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2 align-middle" style="width: 30rem">
                            @foreach($mobility->subjects as $subject)
                                <div class="text-left font-weight-bold text-md">{{ $subject->sub_name }}@if($subject->title === 1)CS @else IS @endif {{ $subject->code }} :</div>
                                <div class="text-left ml-2"><p class="text-justify">{{ $subject->description }}</p></div>
                                @if($loop->last)
                                @else
                                    <hr class="m-0">
                                @endif
                            @endforeach
                        </td>

                        <td class="p-2 align-middle">
                            <p class="font-weight-bold text-lg">{{ $mobility->ours->name }}<br>@if($mobility->ours->title === 1)CS @else IS @endif {{ $mobility->ours->code }}</p>
                        </td>

                        <td class="p-2 align-middle">
                            <p class="font-weight-bold text-lg">{{ $mobility->ours->chr }}</p>
                        </td>

                        <td class="p-2 align-middle" style="width: 30rem">
                            <div class="text-left ml-2"><p class="text-justify"> {{ $mobility->ours->description }}</p></div>
                        </td>

                        <td class="align-middle p-2">
                            <div class="d-inline">

                                <form action="{{ route('approveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-primary btn text-lg font-weight-bold p-1"><i class="far fa-thumbs-up"></i></button>
                                </form>

                                <form action="{{ route('disapproveMobility',$mobility->id) }}" class="d-inline m-0 p-0" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-danger btn text-lg font-weight-bold p-1"><i class="far fa-thumbs-down"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endif
            @endif
        @endforeach
    </table>
</div>
