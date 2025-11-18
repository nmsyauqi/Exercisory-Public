<div class="bg-gray-300 mb-8 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-8">
    
    <div class="bg-blue-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-inner">
        <span class="font-bold text-sm">C:\CHART.EXE</span>
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-4">
        Tren Skor 7 Hari Terakhir
    </h3>
    <div 
        class="bg-gray-200 p-4 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white shadow-inner"
        wire:ignore
        x-data="scoreChart()"
        x-init="initChart()"
    >
        <canvas x-ref="chart" height="120"></canvas>
    </div>
</div>

<script>
function scoreChart() {
    return {
        labels: @json($labels ?? []),
        data: @json($data ?? []),
        chart: null,
        
        initChart() {
            if (this.chart) {
                this.chart.destroy();
            }
            
            const chartCanvas = this.$refs.chart;
            
            this.chart = new Chart(chartCanvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Skor Harian',
                        data: this.data,
                        backgroundColor: 'rgba(0, 255, 0, 0.2)',
                        borderColor: '#00ff00',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#333'
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#333'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }
}
</script>