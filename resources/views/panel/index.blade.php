@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Programando con Laravel 10</h1>
@stop

@section('content')
    <p>HOLA MUNDO DE ADMIN LTE</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .wrapper {
           
            background-image: url('https://www.dexerto.es/cdn-cgi/image/width=3840,quality=75,format=auto/https://editors.dexerto.es/wp-content/uploads/sites/3/2022/09/13/tears-of-the-kingdom.jpg') !important;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop