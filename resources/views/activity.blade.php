<x-app-layout>
    <div class="flex text-blue">
        <div class="w-1/3 p-6">
            <div>
                <h1 class="text-7xl font-bold py-3">{{$activity->name}}</h1>
                <h2 class="text-xl py-3">Owned by: {{$admin_user->name}}</h2>
                <p class="py-3">{{$activity->description}}</p>
            </div>
            <div class="py-5">
                <h1 class="text-4xl py-3">Participants</h1>
                <div>
                    @foreach($activity_users as $activity_user)
                        @if($activity_user != 'null')
                            @foreach($participants as $participant)
                                @if($activity_user == $participant->id)
                                    <p class="p-3 border-2 border-b-0">{{$participant->name}}</p>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <div class="w-auto border-t-2"></div>
                </div>
                <div class="flex justify-end py-4">
                    @if($user == $admin_user)
                        <button class="inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Add Participant</button>
                    @else
                        <button class="inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Leave Activity</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="w-2/3 p-6">
            <div class="bg-blue p-3 rounded-xl" >
                <div class="flex justify-between">
                    <h2 class="text-white text-2xl font-bold">New availability</h2>
                    <h2 class="text-white text-xl">Date: {{$activity->date}}</h2>
                </div>
                <form class="bg-blue p-3 flex" action="{{route("update-availability", $activity->id)}}" method="POST">
                    @csrf
                    <label class="text-lg m-2 text-white align-bottom" for="">From</label>
                    <div class="flex flex-col">
                        <input name="from" class="m-2 " type="number">
                        @error('from')
                        <p class="pl-3 text-red">{{$message}}</p>
                        @enderror
                    </div>

                    <label class="text-lg m-2 text-white align-bottom" for="">Until</label>
                    <div class="flex flex-col">
                        <input name="until" class="m-2 " type="number">
                        @error('until')
                        <p class="pl-3 text-red">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="m-2 inline-flex items-center px-4 py-2 bg-orange rounded-md font-bold text-base text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none disabled:opacity-25 transition ease-in-out duration-150">Update</button>

                </form>
            </div>
            <div class="w-auto h-1/1 m-5">
                <canvas id="activity_chart"></canvas>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
                <script>
                    // setup
                    const data = {
                        labels: <?php echo json_encode($labels) ?>,
                        datasets: [{
                            label: 'Beschikbaarheid',
                            data: <?php echo json_encode($data) ?>,
                            backgroundColor: [
                                'rgba(255, 26, 104, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(0, 0, 0, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 26, 104, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(0, 0, 0, 1)'
                            ],
                            barPercentage: 0.2
                        }]
                    };

                    // config
                    const config = {
                        type: 'bar',
                        data,
                        options: {
                            indexAxis: 'y',
                            scales: {
                                x: {

                                },
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    };

                    // render init block
                    const myChart = new Chart(
                        document.getElementById('activity_chart'),
                        config
                    );
                </script>

            </div>

        </div>
    </div>
</x-app-layout>
