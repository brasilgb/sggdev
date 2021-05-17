
<script>
    // Gráfico produção semanal
        var producaosemana = <?php echo json_encode($producaosemana, JSON_NUMERIC_CHECK); ?>;
        var datasemana = <?php echo json_encode($datasemana); ?>;

        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Produção da Semana'
            },
            subtitle: {
                text: 'Comparativo diário de produção semanal'
            },
            xAxis: {
                categories: datasemana
            },
            yAxis: {
                title: {
                    text: 'Produção %'
                },
                labels: {
                    format: '{value:f}'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '% Produção geral por dia da Semana',
                data: producaosemana
            }]
        });

/*****************Gauge options***********************************/
var gaugeOptions = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
        center: ['50%', '75%'],
        size: '120%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    exporting: {
        enabled: false
    },

    tooltip: {
        enabled: false
    },

    // the value axis
    yAxis: {
        stops: [
            [0.1, '#DF5353'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#55BF3B'] // red
        ],
        lineWidth: 0,
        tickWidth: 0,
        minorTickInterval: null,
        tickAmount: 2,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

// The media gauge
var chartSpeed = Highcharts.chart('container-media', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: {{!$semanaatual->producao?'0':$semanaatual->producao}},
        title: {
            text: 'Produção Semanal'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Media',
        data: [{{!$media ? '0': $media}}],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y:.2f}</span>%<br/>' +
                '<span style="font-size:12px;opacity:0.4">Média</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' Media'
        }
    }]

}));

// The meta gauge
var chartRpm = Highcharts.chart('container-meta', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: 'Produção Semanal'
        }
    },

    series: [{
        name: 'Meta',
        data: [{{!$alcancada?'0':$alcancada}}],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y:.2f}</span>%<br/>' +
                '<span style="font-size:12px;opacity:0.4">' +
                'Meta alcançada' +
                '</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' Meta'
        }
    }]

}));

// Bring life to the dials
// setInterval(function () {
//     // Speed
//     var point,
//         newVal,
//         inc;

//     if (chartSpeed) {
//         point = chartSpeed.series[0].points[0];
//         inc = Math.round((Math.random() - 0.5) * 100);
//         newVal = point.y + inc;

//         if (newVal < 0 || newVal > 200) {
//             newVal = point.y - inc;
//         }

//         point.update(newVal);
//     }

//     // RPM
//     if (chartRpm) {
//         point = chartRpm.series[0].points[0];
//         inc = Math.random() - 0.5;
//         newVal = point.y + inc;

//         if (newVal < 0 || newVal > 5) {
//             newVal = point.y - inc;
//         }

//         point.update(newVal);
//     }
// }, 2000);



// Data e hora *********************************************************
        function atualizaRelogio(){
			var momentoAtual = new Date();

			var vhora = momentoAtual.getHours();
			var vminuto = momentoAtual.getMinutes();
			var vsegundo = momentoAtual.getSeconds();

			var vdia = momentoAtual.getDate();
			var vmes = momentoAtual.getMonth() + 1;
			var vano = momentoAtual.getFullYear();

			if (vdia < 10){ vdia = "0" + vdia;}
			if (vmes < 10){ vmes = "0" + vmes;}
			if (vhora < 10){ vhora = "0" + vhora;}
			if (vminuto < 10){ vminuto = "0" + vminuto;}
			if (vsegundo < 10){ vsegundo = "0" + vsegundo;}

			dataFormat = vdia + "/" + vmes + "/" + vano + " ";
			horaFormat = vhora + ":" + vminuto + ":" + vsegundo;

			document.getElementById("data").innerHTML = dataFormat;
			document.getElementById("hora").innerHTML = horaFormat;

			setTimeout("atualizaRelogio()",1000);
		}
</script>
