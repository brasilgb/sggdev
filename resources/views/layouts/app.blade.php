@php $empresa = App\Models\Empresa::first() @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if ($empresa->logotipo)
        <link rel="shortcut icon" href="{{ asset("storage/thumbnail/{$empresa->logotipo}") }}">
    @else
        <link rel="shortcut icon" href="{{ asset('storage/empresa/sggaicon.png') }}">
    @endif

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGGA - {{ $empresa->razao_social }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">

</head>

<body class="d-flex flex-column h-100">
@php
    $segmento = \App\Models\Empresa::first()
@endphp
    <header>
        @if ($segmento->segmento > 0)
            @include('parts/navbar')
        @endif
    </header>

    <div id="main" class="flex-shrink-0">
        <div class="container fadeIn">
            @yield('content')
        </div>
    </div><!-- /.container -->
    @if ($segmento->segmento > 0)
    @include('parts/footer')
    @endif
    
    @include('parts/scripts')
</body>

</html>
