<template>
    <section class="bg-red-50 pt-5 pb-16 mt-8 px-2">
        <div class="container mx-auto">
            <div class="text-xl font-semibold text-gray-800">
                {{ __("Others have also watched") }}
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div v-for="ad in ads" :key="ad.id" class="">
                    <div class="bg-white p-3">
                        <inertia-link :href="'/ads/' + ad.id" class="">
                            <div class="w-full bg-gray-100">
                                <img
                                    :src="'/media/posts/' + ad.image"
                                    alt=""
                                    class="w-auto mx-auto h-64 lg:h-40"
                                />
                            </div>
                            <div class="text-gray-600 mt-5">
                                {{
                                    lang == "ar"
                                        ? ad.city_name_ar
                                        : ad.city_name
                                }}
                            </div>
                            <div class="font-medium pt-1">{{ ad.title }}</div>
                            <div class="font-medium text-green-500 pt-1">
                                {{ ad.expected_price }}
                                {{ lang == "ar" ? "ع.د" : "IQD" }}
                            </div>
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["ads"],
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
