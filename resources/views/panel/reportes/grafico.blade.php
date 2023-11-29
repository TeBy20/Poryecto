@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<h1>Grafico de Barras</h1>
@stop

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center h-100">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <strong>Vehículos Retirados por Mes</strong>
            </div>
        </div>
        <div class="card-body">
            <!-- Ajusta el ancho y alto del canvas para ocupar toda la pantalla -->
            <canvas id="barChart" style="width: 100%; height: 100%;"></canvas>
        </div>
    </div>
</div>

@stop

@section('css')

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(function() {
        const barChart = document.getElementById('barChart').getContext('2d');

        // AJAX request to extract data from the database and graph
        $.get("{{ route('graficocategoriaxestado') }}", function(response) {
            response = JSON.parse(response);

            // If the request was successful
            if (response.success) {
                const labels = response.data.labels;
                const counts = response.data.counts;

                // To graph the Bar Chart (BarChart)
                graficar(barChart, 'bar', labels, counts, 'Cantidad de vehículos retirados por mes', null);
            } else {
                console.log(response.message);
            }
        });

        // Function to graph any statistical chart of ChartJs
        function graficar(context, typeGraphic, label, counts, title, inputData) {
            // Start of ChartJs configuration
            let configChart = {
                type: typeGraphic,
                data: {
                    labels: label,
                    datasets: [{
                        label: title,
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                    }],
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                            },
                        }],
                    },
                    legend: {
                        display: false, // No mostrar leyenda
                    },
                    title: {
                        display: true,
                        text: title,
                    },
                },
            };

            // Save the string in the input data of the corresponding form
            if (inputData) {
                inputData.val(JSON.stringify(configChart));
            }

            // Ajusta el tamaño del canvas según tus necesidades
            context.canvas.width = 800;
            context.canvas.height = 400;

            // JSON.parse(string) -> converts the string to JSON
            let myChart = new Chart(context, configChart);
        }
    });
</script>
@stop