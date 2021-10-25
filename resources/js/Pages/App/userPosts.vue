<template>
    <app-layout>
        <h2 class="container mx-auto font-semibold text-lg mt-5">
            Ads by {{ this.$page.props.user.name }}
        </h2>
        <products v-if="posts.data.length" :posts="posts.data"></products>
        <div
            v-else
            class="text-center text-2xl text-gray-500 my-10 border border-gray-500 py-5"
        >
            {{ __("No Ad found by") }} {{ this.$page.props.user.name }}
        </div>
        <pagination
            class="mb-5"
            v-if="posts.data.length"
            :links="posts.links"
            :from="posts.from"
            :to="posts.to"
            :total="posts.total"
        ></pagination>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import products from "@/Components/Products";
import pagination from "@/Components/Pagination";
export default {
    props: ["posts"],
    components: {
        AppLayout,
        products,
        pagination
    }
};
</script>
