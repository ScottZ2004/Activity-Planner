<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 flex justify-center flex-col">
        <h1 class="p-10 text-blue text-6xl font-bold text-center">Add Participant</h1>
        @foreach($users as $user_)
            @if($user_ != $user)
                <section class="m-4 py-4 rounded mx-10 border-b-4 border-lightorange flex justify-between hover:bg-darker-white hover:cursor-pointer">
                    <h2 class="text-blue text-5xl">{{$user_->name}}</h2>
                    <form action="{{route('update-Participants', ['slug' => $slug, 'participant' => $user_->id] )}}" method="post">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Add</button>
                    </form>
                </section>
            @endif
        @endforeach
    </div>
</x-app-layout>
