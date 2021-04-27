<div class="row mb-4">
    <div class="col-12">
        <div style="font: bold italic 1rem sans-serif" class="bg-gray-400 p-2 text-center">Relatório financeiro - data do
            relatório: {{ $datarelatorio }}</div>
    </div>
</div>

<table class="table table-bordered table-condensed mb2">
    <tr>
        <th style="font: bold italic 1rem sans-serif" colspan="4" class="bg-gray-400 text-center">Resumo financeiro geral</th>
    </tr>
    <tr class="bg-gray-200">
        <th>Despesas</th>
        <th>Receita</th>
        <th>Saldo</th>
        <th>Margem%</th>
    </tr>
    <tr>
        @php
        $despesa = $despesas->sum->valor;
        $receita = $coletas->sum->postura_dia * $receitas->valor_ovo;
        $lucro = ($coletas->sum->postura_dia * $receitas->valor_ovo) - $despesas->sum->valor;
        @endphp
        <td>R$ {{ number_format($despesa, 2,',', '') }}</td>
        <td>R$ {{ number_format($receita, 2,',', '') }}</td>
        <td>R$ {{ number_format($lucro, 2,',', '') }}</td>

        <td>{{ number_format(($lucro / $receita) * 100, 2,',', '') }}%</td>
    </tr>
</table>

<table class="table table-bordered table-condensed mb2">
    <tr>
        <th colspan="3" style="font: bold italic 1rem sans-serif" class="text-center bg-gray-400">Fonte de receita</th>
    </tr>
    <tr>
        <th>Ovos totais</th>
        <th>Valor unitário</th>
        <th>Receita</th>
    </tr>
    <tr>
        <td>{{ $coletas->sum->postura_dia }}</td>
        <td>R$ {{ number_format($receitas->valor_ovo, 2,',', '') }}</td>
        <td>R$ {{ number_format($receita, 2,',', '') }}</td>
    </tr>

</table>

<table class="table table-bordered table-condensed mb2">
    <tr>
        <th colspan="4" style="font: bold italic 1rem sans-serif" class="text-center bg-gray-400">Despesas Mês
            ({{ strftime('%B', strtotime('today')) }})</th>
    </tr>
    <tr>
        <th>Vencimento</th>
        <th>Descrição</th>
        <th>Situação</th>
        <th style="width: 25%;">Valor</th>
    </tr>
    @foreach ($despesas as $despesa)
    <tr>
        <td>{{ date("d/m/Y", strtotime($despesa->vencimento)) }}</td>
        <td>{{ $despesa->descritivo }}</td>
        <td>{{ $despesa->situacao }}</td>
        <td class="bg-gray-200">R$ {{ number_format($despesa->valor, 2,',', '') }}</td>
    </tr>
    @endforeach
    <tr class="bg-gray-200">
        <th colspan="3">Total</th>
        <th>R$ {{ number_format($despesas->sum->valor, 2,',', '') }}</th>

    </tr>
</table>
