<template>
  <div>
    <vs-row>
      <case-card class="w-full">
        <vue-apex-charts type="pie" height="350" :options="pieChart.chartOptions" :series="pieChart.series"></vue-apex-charts>
        <vue-apex-charts type="bar" height="350" :options="barChart.chartOptions" :series="barChart.series"></vue-apex-charts>
      </case-card>
      <case-card class="w-full mt-5">
      </case-card>
    </vs-row>
  </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts';

export default {
    data() {
        return {
            themeColors: ['#CC0000', '#CC0000'],
            pieChart: {
                series: [10, 5, 12, 6],
                chartOptions: {
                    labels: ['바나나', '사과', '포도', '딸기'],
                    colors: ['#5b3cc4', '#FF3300', '#003300', '#FF33FF'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: 'bottom',
                            },
                        },
                    }],
                },
            },
            barChart: {
                series: [{
                    data: [10, 5, 12, 6],
                }],
                chartOptions: {
                    colors: ['#5b3cc4', '#FF3300', '#003300', '#FF33FF'],
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    xaxis: {
                        categories: ['바나나', '사과', '포도', '딸기'],
                    },
                },
            },
        };
    },
    components: {
        VueApexCharts,
    },
};
</script>

<style>

</style>
