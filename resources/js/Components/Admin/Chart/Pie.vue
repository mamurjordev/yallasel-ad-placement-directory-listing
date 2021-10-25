<template>
    <div class="bg-white">
        <apexchart
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
            series: this.data.counts,
            chartOptions: {
                labels: this.data.titles,

                chart: {
                    type: "donut"
                },
                title: {
                    text: this.info.title,
                    align: "left"
                }
            }
        };
    }
};
</script>
