import ApexCharts from 'apexcharts';

export default class ChartService {

    charts = {};

    crearDonut(id, series = [], labels = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) {
            return;
        }

        if (this.charts[id]) {

            this.charts[id].updateOptions({
                labels
            });

            this.charts[id].updateSeries(series);

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'donut',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            labels,

            colors: [
                '#16a34a',
                '#ef4444',
                '#3b82f6',
                '#f59e0b',
                '#8b5cf6'
            ],

            legend: {
                position: 'bottom'
            },

            dataLabels: {
                enabled: true
            },

            stroke: {
                width: 0
            }

        });

        chart.render();

        this.charts[id] = chart;
    }

    crearBarra(id, categorias = [], series = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) {
            return;
        }

        if (this.charts[id]) {

            this.charts[id].updateOptions({
                xaxis: {
                    categories: categorias
                }
            });

            this.charts[id].updateSeries(series);

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'bar',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            xaxis: {
                categories: categorias
            },

            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 6,
                    columnWidth: '45%',
                }
            },

            dataLabels: {
                enabled: false
            },

            colors: [
                '#16a34a'
            ],

            grid: {
                borderColor: '#e5e7eb'
            },

            yaxis: {
                labels: {
                    formatter: function (value) {
                        return Math.round(value);
                    }
                }
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearLinea(id, categorias = [], series = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateOptions({
                xaxis: {
                    categories: categorias
                }
            });

            this.charts[id].updateSeries(series);

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'line',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            xaxis: {
                categories: categorias
            },

            stroke: {
                curve: 'smooth',
                width: 3
            },

            markers: {
                size: 5
            },

            colors: ['#16a34a'],

            dataLabels: {
                enabled: false
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearArea(id, categorias = [], series = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateOptions({
                xaxis: {
                    categories: categorias
                }
            });

            this.charts[id].updateSeries(series);

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'area',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            xaxis: {
                categories: categorias
            },

            stroke: {
                curve: 'smooth',
                width: 3
            },

            fill: {
                opacity: 0.25
            },

            colors: ['#16a34a']

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearPie(id, series = [], labels = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateSeries(series);

            this.charts[id].updateOptions({
                labels
            });

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'pie',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            labels,

            legend: {
                position: 'bottom'
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearRadial(id, series = [], labels = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateSeries(series);

            this.charts[id].updateOptions({
                labels
            });

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'radialBar',
                height: alto
            },

            series,

            labels,

            colors: ['#16a34a']

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearPolar(id, series = [], labels = [], alto = 200) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateSeries(series);

            this.charts[id].updateOptions({
                labels
            });

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'polarArea',
                height: alto,
                toolbar: {
                    show: false
                }
            },

            series,

            labels,

            stroke: {
                colors: ['#fff']
            },

            fill: {
                opacity: 0.9
            },

            legend: {
                position: 'bottom'
            },

            colors: [
                '#16a34a',
                '#22c55e',
                '#4ade80',
                '#86efac',
                '#bbf7d0'
            ]

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearSparkline(id, series = [], color = '#16a34a', alto =45) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateSeries([{
                data: series
            }]);

            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'area',
                height: alto,
                width: 180,
                sparkline: {
                    enabled: true
                },
                toolbar: {
                    show: false
                }
            },

            series: [{
                data: series
            }],

            stroke: {
                curve: 'smooth',
                width: 2
            },

            fill: {
                opacity: 0.25
            },

            colors: [color],

            tooltip: {
                enabled: true
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearMiniBar(id, series = [], color = '#16a34a', alto =45) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {
            this.charts[id].updateSeries([{
                data: series
            }]);
            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'bar',
                height: alto,
                sparkline: {
                    enabled: true
                },
                toolbar: {
                    show: false
                }
            },

            series: [{
                data: series
            }],

            colors: [color],

            plotOptions: {
                bar: {
                    columnWidth: '60%',
                    borderRadius: 2
                }
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearMiniLinea(id, series = [], color = '#2563eb', alto =45) {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {
            this.charts[id].updateSeries([{
                data: series
            }]);
            return;
        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'line',
                height: alto,
                sparkline: {
                    enabled: true
                },
                toolbar: {
                    show: false
                }
            },

            series: [{
                data: series
            }],

            colors: [color],

            stroke: {
                width: 2,
                curve: 'smooth'
            }

        });

        chart.render();

        this.charts[id] = chart;

    }

    crearMiniRadial(id, valor = 0, color = '#16a34a') {

        const elemento = document.getElementById(id);

        if (!elemento) return;

        if (this.charts[id]) {

            this.charts[id].updateSeries([valor]);

            return;

        }

        const chart = new ApexCharts(elemento, {

            chart: {
                type: 'radialBar',
                height: 120,
                width: 110,
                sparkline: {
                    enabled: true
                }
            },

            series: [valor],

            colors: [color],

            plotOptions: {

                radialBar: {

                    hollow: {
                        size: '20%'
                    },

                    dataLabels: {

                        name: {
                            show: false
                        },

                        value: {
                            show: false
                        }

                    }

                }

            }

            // plotOptions: {

            //     radialBar: {

            //         hollow: {
            //             size: '45%'      // agujero más pequeño
            //         },

            //         track: {
            //             background: '#F3F4F6',
            //             strokeWidth: '100%'
            //         },

            //         dataLabels: {
            //             show: false
            //         }

            //     }

            // },

        });

        chart.render();

        this.charts[id] = chart;

    }


}