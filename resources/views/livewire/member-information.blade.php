<div class="flex flex-col space-y-8 sm:flex-row sm:justify-around w-full mt-8 items-center">
    <div class="">
        <img src="/assets/students.webp" alt="students" width="150" height="150">
        <div class="font-semibold text-center">Anggota</div>
        <div class="text-center">{{ $members }}</div>
    </div>
    <div class="text-center">
        <div class="font-semibold"> Jenjang Pendidikan Mahasiswa</div>
        <canvas id="outlabeledChart" class="" width="150" height="150"></canvas>
    </div>
    <div class="text-center">
        <img src="/assets/graduation.webp" alt="graduation" width="150" height="150">
        <div class="font-semibold text-center">Alumni</div>
        <div class="text-center">{{ $graduates}}</div>
    </div>

</div>

@push('scripts')
    
<script src="{{ config('app.url') }}/vendor/chart.js/Chart.min.js"></script>
<script src="{{ config('app.url') }}/vendor/chart.js/chartjs-plugin-piechart-outlabels.min.js"></script>
<script>
    const data = {!! json_encode($educations) !!};
    var ctx = document.getElementById('outlabeledChart');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.map((item)=>item.type_of_education),
            datasets: [{
                backgroundColor: [
                    '#FF3784',
                    '#36A2EB',
                    '#4BC0C0',
                ],
                data: data.map((item)=>item.count)
            }]
        },
        options: {
            layout:{
                padding: 50
            },
            plugins: {
                legend: {
                    display: false
                },
                outlabels: {
                    display: true,
                    lineWidth: 1,
                    padding: 1,
                    stretch: 10,
                    textAlign: 'center',
                    font: {
                        resizable: true,
                        minSize: 12,
                        maxSize: 16
                    },
                    color: '#565656',
                    backgroundColor: 'red',
                    valuePrecision: 0,
                    percentPrecision: 2,
                    text: '%l\n%v',
                }
            }
        },
        plugins: [
            ChartPieChartOutlabels
        ]
    });
</script>

@endpush

