<template>
    <app-layout>
        <section class="bg-white">
            <div class="container mx-auto text-gray-800">
                <h4 class="font-bold mt-5 text-2xl">
                    {{ __("All categories") }}
                </h4>
                <div class="grid grid-cols-3">
                    <div
                        class="mt-8"
                        v-for="category in categories"
                        :key="category.id"
                    >
                        <div class="font-medium capitalize">
                            <inertia-link :href="'/category/' + category.id"
                                >{{
                                    lang == "ar"
                                        ? category.category_name_ar
                                        : category.category_name
                                }}
                                <span class="text-xs"
                                    >({{ category.items_count }})</span
                                ></inertia-link
                            >
                        </div>
                        <div
                            v-if="childs"
                            class="font-light space-y-2 mt-2 grid grid-cols-1"
                        >
                            <inertia-link
                                v-for="child in childs.data"
                                :key="child.id"
                                :href="'/category/' + child.id"
                                class="hover:underline capitalize"
                                >{{
                                    lang == "ar"
                                        ? child.category_name_ar
                                        : child.category_name
                                }}</inertia-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    props: ["categories"],
    components: {
        AppLayout
    },
    data() {
        return {
            childs: null
        };
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    },
    mounted() {
        axios
            .get("api/v1/child_categories/1")
            .then(response => (this.childs = response));
    }
};
</script>
