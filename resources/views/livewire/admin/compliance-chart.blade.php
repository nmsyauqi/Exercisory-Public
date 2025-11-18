<div class="bg-gray-300 border-t-4 border-l-4 border-white border-r-4 border-b-4 border-gray-700 shadow-[8px_8px_0_0_#000000] p-4 sm:p-8">
    
    <div class="bg-blue-700 text-white p-1.5 mb-6 border-t-2 border-l-2 border-blue-400 border-r-2 border-b-2 border-blue-900 shadow-inner">
        <span class="font-bold text-sm">C:\ADMIN\CHART.EXE</span>
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-4">
        Persentase Peserta Berpartisipasi 7 Hari Terakhir
    </h3>
    <div 
        class="bg-gray-200 p-4 border-t-2 border-l-2 border-gray-700 border-r-2 border-b-2 border-white shadow-inner"
        wire:ignore 
        x-data="complianceChart()"
        x-init="initChart()"
    >
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas x-ref="chart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script>
function complianceChart() {
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
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Kepatuhan Harian (%)',
                        data: this.data,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 2,
                        // Bar akan mengisi ruang yang tersedia dengan persentase
                        categoryPercentage: 0.9, // 90% dari kategori (spacing antar grup)
                        barPercentage: 0.8 // 80% dari kategori (lebar bar sendiri)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                color: '#333',
                                callback: function(value) {
                                    return value + '%';
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: { 
                                color: '#333',
                                autoSkip: true,
                                maxRotation: 45,
                                minRotation: 0
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: false 
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Berpartisipasi: ' + context.parsed.y + '%';
                                }
                            }
                        }
                    }
                }
            });
        }
    }
}
</script>
@endpush