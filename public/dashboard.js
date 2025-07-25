document.addEventListener('DOMContentLoaded', function () {
    const ctxDespesas = document.getElementById('graficoDespesas');
    if (ctxDespesas) {
        const labels = JSON.parse(ctxDespesas.dataset.labels);
        const data = JSON.parse(ctxDespesas.dataset.valores);

        new Chart(ctxDespesas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Maior despesa (R$)',
                    data: data,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'R$ ' + value.toLocaleString('pt-BR')
                        }
                    }
                }
            }
        });
    }

    const ctxProfissoes = document.getElementById('graficoProfissoes');
    if (ctxProfissoes) {
        const labels = JSON.parse(ctxProfissoes.dataset.labels);
        const data = JSON.parse(ctxProfissoes.dataset.valores);

        new Chart(ctxProfissoes, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantidade de Deputados',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const ctxPartido = document.getElementById('graficoDeputadosPorPartido');
    if (ctxPartido) {
        const labels = JSON.parse(ctxPartido.dataset.labels);
        const data = JSON.parse(ctxPartido.dataset.valores);

        new Chart(ctxPartido, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Deputados por Partido',
                    data: data,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#66BB6A', '#D4E157'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
