<template>
    <admin-layout>
        <h5 class="text-center text-red-900">Hello</h5>
        <BarChart :count="postsCount" class="shadow-xl" />
        <div class="grid md:grid-cols-2 mt-5 gap-3">
            <PieChart
                :data="postsByCategory"
                :info="postByCategory"
                class="shadow-xl"
            />
            <PieChart
                :data="usersByRoles"
                :info="usersByRole"
                class="shadow-xl"
            />
            <TreeChart :data="usersByCities" :info="usersByCity" />
            <TreeChart :data="usersByRegions" :info="usersByRegion" />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import BarChart from "@/Components/Admin/Chart/Bar";
import PieChart from "@/Components/Admin/Chart/Pie";
import TreeChart from "@/Components/Admin/Chart/Tree";
export default {
    props: [
        "postsCount",
        "postsByCategory",
        "usersByRoles",
        "usersByCities",
        "usersByRegions"
    ],
    components: {
        AdminLayout,
        BarChart,
        PieChart,
        TreeChart
    },
    data() {
        return {
            postByCategory: {
                title: "Ads by category"
            },
            usersByRole: {
                title: "Users by roles"
            },
            usersByCity: {
                title: "Users by cities"
            },
            usersByRegion: {
                title: "Users by regions"
            }
        };
    }
};
</script>
