@php
$empresaexist = App\Models\Empresa::first();
$periodo = App\Models\Periodo::exists();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if (!empty($empresaexist->logotipo))
        <link rel="shortcut icon" href="{{ asset("storage/thumbnail/{$empresaexist->logotipo}") }}">
    @else
        <link rel="shortcut icon" href="{{ asset('storage/images/logo_padrao.png') }}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGGA - {{ empty($empresaexist->razao_social) ? '': $empresaexist->razao_social}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/graficos.css') }}">

</head>

<body class="d-flex flex-column h-100">

    @guest
        <div class="container">
            @yield('content')
        </div>
    @else

        <header>
            @if (!empty($empresaexist) and $empresaexist->segmento > 0)
                @include('parts/navbar')
            @endif
        </header>

        <div id="main" class="flex-shrink-0">
            <div class="container fadeIn">
                @yield('content')
            </div>
        </div><!-- /.container -->
        @if (!empty($empresaexist) and $empresaexist->segmento > 0)
            @include('parts/footer')
        @endif

        @include('parts/scripts')
    @endguest
</body>

</html>
