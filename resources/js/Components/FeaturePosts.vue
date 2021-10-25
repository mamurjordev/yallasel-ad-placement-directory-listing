<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-2 mb-2">
            <h2 class="text-2xl font-medium">
                {{ header }}
            </h2>
            <inertia-link :href="more" class="text-end text-sm"
                >{{ __("More") }}
                <i
                    class="fas fa-chevron-right text-xs"
                    :style="lang == 'ar' ? 'transform: scaleX(-1)' : ''"
                ></i
            ></inertia-link>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <inertia-link
                v-for="post in posts"
                :key="post.id"
                :href="'/ads/' + post.id"
                class="border-b-2 border-gray-400 rounded bg-white shadow-lg overflow-hidden"
            >
                <div class="relative border border-gray-300">
                    <img
                        :src="'media/posts/' + post.image"
                        :alt="post.title"
                        class="w-auto h-72 mx-auto"
                    />

                    <div
                        class="absolute top-0 start-0 capitalize bg-gray-800 border border-black shadow-md rounded px-2 text-white m-1 font-semibold"
                    >
                        {{
                            lang == "ar"
                                ? post.category_name_ar
                                : post.category_name
                        }}
                    </div>
                </div>
                <h3 class="text-lg font-semibold mt-1 p-2 hover:underline">
                    {{ post.title }}
                </h3>
                <div class="flex justify-between px-2">
                    <div class="">
                        {{ __("Reason") }}:
                        <span class="font-semibold">{{ post.reason }}</span>
                    </div>
                    <div class="">
                        {{ __("City") }}:
                        <span class="font-semibold">{{
                            lang == "ar" ? post.city_name_ar : post.city_name
                        }}</span>
                    </div>
                </div>
                <div
                    class="text-xl font-semibold text-green-700 float-end mt-1 p-2"
                >
                    {{ post.expected_price }} {{ iqd }}
                </div>
            </inertia-link>
        </div>
        <!-- {{ posts }} -->
    </div>
</template>

<script>
export default {
    props: ["header", "posts", "more"],
    data() {
        return {
            iqd: lang == "ar" ? "ع.د" : "IQD"
        };
    },
    computed: {
        lang() {
            return this.$page.props.language;
        }
    }
};
</script>
