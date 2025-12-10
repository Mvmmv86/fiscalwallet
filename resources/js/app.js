import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import ApexCharts from 'apexcharts';

// Alpine.js
Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();

// ApexCharts global
window.ApexCharts = ApexCharts;

// Chart default options for Fiscal Wallet
window.FiscalWalletCharts = {
    colors: {
        primary: '#9333EA',
        primaryLight: '#A855F7',
        success: '#22C55E',
        danger: '#EF4444',
        warning: '#F59E0B',
        gray: '#6B7280',
    },

    defaultOptions: {
        chart: {
            fontFamily: 'Inter, system-ui, sans-serif',
            toolbar: {
                show: false,
            },
        },
        colors: ['#9333EA', '#22C55E'],
        stroke: {
            curve: 'smooth',
            width: 3,
        },
        grid: {
            borderColor: '#E5E7EB',
            strokeDashArray: 4,
        },
        tooltip: {
            theme: 'light',
            style: {
                fontFamily: 'Inter, system-ui, sans-serif',
            },
        },
        xaxis: {
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                },
                formatter: function(value) {
                    return 'R$ ' + value.toLocaleString('pt-BR');
                },
            },
        },
    },

    // Line chart for dashboard
    createLineChart(element, series, categories) {
        const options = {
            ...this.defaultOptions,
            chart: {
                ...this.defaultOptions.chart,
                type: 'line',
                height: 300,
            },
            series: series,
            xaxis: {
                ...this.defaultOptions.xaxis,
                categories: categories,
            },
        };

        return new ApexCharts(element, options);
    },

    // Donut chart for assets
    createDonutChart(element, series, labels) {
        const options = {
            chart: {
                type: 'donut',
                height: 280,
                fontFamily: 'Inter, system-ui, sans-serif',
            },
            series: series,
            labels: labels,
            colors: ['#9333EA', '#A855F7', '#C084FC', '#D8B4FE', '#E9D5FF'],
            legend: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%',
                    },
                },
            },
            stroke: {
                show: false,
            },
        };

        return new ApexCharts(element, options);
    },
};

// Format currency helper
window.formatCurrency = function(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
    }).format(value);
};

// Format date helper
window.formatDate = function(date) {
    return new Intl.DateTimeFormat('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
    }).format(new Date(date));
};

// Format datetime helper
window.formatDateTime = function(date) {
    return new Intl.DateTimeFormat('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }).format(new Date(date));
};
