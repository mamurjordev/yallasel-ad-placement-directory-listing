<template>
    <div class="overflow-x-auto">
        <section
            class="container mx-auto inline-flex justify-between space-s-3 md:space-s-0 md:grid md:grid-cols-3 px-3 pb-3"
        >
            <inertia-link
                v-for="category in categories"
                :key="category.id"
                :href="'/category/' + category.id"
                class="text-primary font-bold min-w-max bg-3 capitalize"
                >{{
                    lang == "ar"
                        ? category.category_name_ar
                        : category.category_name
                }}
                <span class="text-gray-400 font-light text-xs"
                    >({{ category.items_count }})</span
                ></inertia-link
            >
            <a
                v-if="categories.length > 8"
                href="#!"
                class="text-sm font-light text-gray-700 min-w-max hidden md:block"
                >{{ __("Show all") }}
                <i class="fas fa-chevron-down text-gray-500"></i
            ></a>
        </section>
    </div>
</template>

<script>
export default {
    props: ["categories"],
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
