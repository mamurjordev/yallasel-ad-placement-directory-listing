<template>
    <div class="bg-white">
        <apexchart
            type="bar"
            height="350"
            :options="chartOptions"
            :series="series"
        ></apexchart>
    </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
    props: ["count"],
    components: {
        apexchart: VueApexCharts
    },
    data() {
        return {
            series: [
                {
                    name: "Ad posts",
                    data: this.count
                }
            ],
            chartOptions: {
                chart: {
                    height: 350,
                    type: "bar"
                },
                dataLabels: {
                    enabled: false
                },
                title: {
                    text: "Ad posted by Month",
                    align: "left"
                },
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.5
                    }
                },
                plotOptions: {
                    bar: {
                        distributed: true
                    }
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec"
                    ]
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true,
                    labels: {
                        show: true
                    },
                    title: {
                        text: "Post Count"
                    }
                }
            }
        };
    }
};
</script>
