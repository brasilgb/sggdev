<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/pdf.css') }}">
    <style></style>
    <title>Relatório de Coletas</title>
</head>

<body>
    @if ($segmento->segmento == 1)
    @include('relatorios/coleta/frangos/relcoleta')
    @else
    @include('relatorios/coleta/perus/relcoleta')
    @endif
</body>

</html>
