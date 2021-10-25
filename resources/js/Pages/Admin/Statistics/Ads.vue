<template>
    <admin-layout>
        <div class="grid gap-3">
            <BarChart :count="postsCount" class="shadow-xl" />
            <PieChart
                :data="postsByCategory"
                :info="postByCategory"
                class="shadow-xl"
            />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import BarChart from "@/Components/Admin/Chart/Bar";
import PieChart from "@/Components/Admin/Chart/Pie";
export default {
    props: ["postsCount", "postsByCategory"],
    components: {
        AdminLayout,
        BarChart,
        PieChart
    },
    data() {
        return {
            postByCategory: {
                title: "Ads by category"
            }
        };
    }
};
</script>
