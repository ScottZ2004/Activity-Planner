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
        <div class="w-3/4">
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
            <div class="h-96 ">
                <div class="w-3/4">
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
    </div>
</x-app-layout>
