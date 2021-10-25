<template>
    <div class="bg-white shadow-xl">
        <apexchart
            type="treemap"
            height="350"
            :options="chartOptions"
            :series="series"
        ></apexchart>
    </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
export default {
    props: ["data", "info"],
    components: {
        apexchart: VueApexCharts
    },
    data() {
        return {
            series: [
                {
                    data: this.data
                }
            ],
            chartOptions: {
                legend: {
                    show: false
                },
                chart: {
                    height: 350,
                    type: "treemap"
                },
                title: {
                    text: this.info.title,
                    align: "center"
                },
                colors: [
                    "#3B93A5",
                    "#F7B844",
                    "#ADD8C7",
                    "#EC3C65",
                    "#CDD7B6",
                    "#C1F666",
                    "#D43F97",
                    "#1E5D8C",
                    "#421243",
                    "#7F94B0",
                    "#EF6537",
                    "#C0ADDB"
                ],
                plotOptions: {
                    treemap: {
                        distributed: true,
                        enableShades: false
                    }
                }
            }
        };
    }
};
</script>
