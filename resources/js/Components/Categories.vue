<template>
    <!-- {{-- Categories --}} -->
    <section class="container mx-auto px-2">
        <div class="grid grid-cols-2">
            <h4 class="text-2xl font-bold mt-5 mb-3">
                {{ __("Discover our categories") }}
            </h4>
            <inertia-link href="/categories" class="text-end pt-8 text-sm"
                >{{ __("All categories") }}
                <i
                    class="fas fa-chevron-right text-xs"
                    :style="lang == 'ar' ? 'transform: scaleX(-1)' : ''"
                ></i
            ></inertia-link>
        </div>
        <div class="md:flex md:justify-between uppercase">
            <div class="overflow-x-auto">
                <div
                    class="uppercase space-s-4 inline-flex justify-between h-max py-6"
                >
                    <inertia-link
                        v-for="category in categories"
                        :key="category.id"
                        :href="'/category/' + category.id"
                        class="text-center w-20"
                    >
                        <div
                            class="bg-white shadow-lg rounded-full transform hover:scale-110 transition duration-100 mx-auto w-14 h-14 pt-3"
                        >
                            <img
                                :src="'/media/categories/' + category.image"
                                alt=""
                                class="h-8 w-8 mx-auto"
                            />
                        </div>
                        <p class="text-sm font-mediuym mt-1">
                            {{
                                lang == "ar"
                                    ? category.category_name_ar
                                    : category.category_name
                            }}
                        </p>
                    </inertia-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        categories: Array
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
