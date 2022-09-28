<x-app-layout>
    <div class="flex">
        <div class="w-1/4">
            <div>
                <h1>{{$activity->name}}</h1>
                <h2>Owned by: {{$admin_user->name}}</h2>
                <p class="p-2 border">{{$activity->description}}</p>
            </div>
            <div>
                <h1>Participants</h1>
                <div>
                    @foreach($activity_users as $activity_user)
                        @if($activity_user != 'null')
                            @foreach($participants as $participant)
                                @if($activity_user == $participant->id)
                                    <p>{{$participant->name}}</p>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
                @if($user == $admin_user)
                    <button>Add Participant</button>
                @else
                    <button>Leave Activity</button>
                @endif

            </div>
        </div>
        <div class="w-3/4 flex">
            <div>
                <div>
                    <h2>New availability</h2>
                    <h2>Date: {{$activity->date}}</h2>
                </div>
                <form class="bg-blue p-3" action="" method="">
                    <label for="">From</label>
                    <input type="time">
                    <label for="">Until</label>
                    <input type="time">
                    <button>Update</button>
                </form>
            </div>
            <div class="h-96 bg-red">
                <p>hier komt grafiek</p>
            </div>
        </div>
    </div>



</x-app-layout>
