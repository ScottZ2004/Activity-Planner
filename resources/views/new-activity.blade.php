<x-app-layout>
    <div class="p-12 flex flex-col items-center font-bold text-blue">
        <h1 class="text-6xl p-5">New Activity</h1>
        <form action="{{ route('create_activity') }}" method="POST">
            @csrf
            <label class="mt-4">
                <h3>Name Activity</h3>
                <input name="name" class="border-blue border-2" type="text">
                @error('name')
                    <p class="text-red">{{$message}}</p>
                @enderror
            </label>
            <label class="mt-4">
                <h3>Day</h3>
                <input name="date" class="border-blue border-2" type="date">
                @error('date')
                <p class="text-red">{{$message}}</p>
                @enderror
            </label>
            <label class="mt-4">
                <h3>Name Activity</h3>
                <textarea name="description" class="border-blue border-2" cols="30" rows="10"></textarea>
            </label>
            <label class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Create</button>
            </label>
        </form>
    </div>
</x-app-layout>
