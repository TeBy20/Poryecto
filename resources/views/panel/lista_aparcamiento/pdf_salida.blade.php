<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte PDF</title>

    <link rel="stylesheet" href="{{ public_path('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        body {
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 50px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 40px;
            margin-bottom: 20px;
        }

        .card {
            width: 400px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .ticket-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .ticket-info img {
            width: 100px;
            height: 100px;
            margin-top: 20px;
        }

        .code {
            font-size: 100px;
            font-weight: bold;
            margin-top: 20px;
        }

        img {
            width: 170px;
            height: 220px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Ticket de ingreso</h1>

        <h2>Radiador Springs</h2>

        <img src="https://cdn-icons-png.flaticon.com/512/2760/2760871.png" alt="Logo">

        <div class="ticket-info">
            <div class="item">
                <strong>Número de placa:</strong> {{ $vehiculo->placa_vehiculo }}
            </div>
            <div class="item">
                <strong>Categoría:</strong> {{ $vehiculo->categoria->nombre_categoria }}
            </div>
            <div class="item">
                <strong>Fecha de Entrada:</strong> {{ $vehiculo->fecha_entrada }}
            </div>
            <div class="item">
                <strong>Hora de Entrada:</strong> {{ $vehiculo->hora_entrada }}
            </div>
            <div class="code">
                {{ $vehiculo->codigo }}
            </div>
        </div>
        

    </div>

</body>
</html>
