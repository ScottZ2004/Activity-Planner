<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center flex-col">
       <h1 class="p-10 text-blue text-6xl font-bold text-center">My Activities</h1>
        @foreach($activities as $activity)
            @if($activity->admin_id == $user->id || $activity->participant1_id == $user->id || $activity->participant2_id == $user->id || $activity->participant3_id == $user->id || $activity->participant4_id == $user->id || $activity->participant5_id == $user->id || $activity->participant6_id == $user->id)
                <section onclick="window.location='{{route("activity", $activity->id)}}}'" class="m-4 py-4 rounded mx-10 border-b-4 border-lightorange flex justify-between hover:bg-darker-white hover:cursor-pointer">
                    <h2 class="text-blue text-5xl">{{$activity->name}}</h2>
                </section>
            @endif
        @endforeach
    </div>
</x-app-layout>
