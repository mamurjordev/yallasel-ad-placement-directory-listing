<template>
    <div
        class="breadcrumbs container mx-auto text-sm text-gray-600 font-light my-8 px-3"
    >
        <inertia-link href="/" class="hover:underline font-normal">{{
            __("Home")
        }}</inertia-link>
        <inertia-link
            :href="bread.url"
            class="capitalize hover:underline font-normal"
            v-for="bread in breads"
            :key="bread.id"
        >
            <i v-if="lang == 'ar'" class="fas fa-chevron-left text-xs px-2"></i>
            <i v-else class="fas fa-chevron-right text-xs px-2"></i>
            {{ bread.label }}
        </inertia-link>
    </div>
</template>

<script>
export default {
    props: ["breads"],
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
