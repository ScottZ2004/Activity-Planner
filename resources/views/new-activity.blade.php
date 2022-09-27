<x-app-layout>
    <div class="p-12 flex flex-col items-center font-bold text-blue">
        <h1 class="text-6xl p-5">New Activity</h1>
        <form action="">
            <div>
                <h3>Name Activity</h3>
                <input class="border-blue border-2" type="text">
            </div>
            <div>
                <h3>Day</h3>
                <input class="border-blue border-2" type="date">
            </div>
            <div>
                <h3>Name Activity</h3>
                <textarea class="border-blue border-2" cols="30" rows="10"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Create</button>
            </div>
        </form>
    </div>
</x-app-layout>
