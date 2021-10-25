<template>
    <admin-layout>
        <div class="grid gap-3">
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
import PieChart from "@/Components/Admin/Chart/Pie";
import TreeChart from "@/Components/Admin/Chart/Tree";
export default {
    props: ["usersByRoles", "usersByCities", "usersByRegions"],
    components: {
        AdminLayout,
        PieChart,
        TreeChart
    },
    data() {
        return {
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
