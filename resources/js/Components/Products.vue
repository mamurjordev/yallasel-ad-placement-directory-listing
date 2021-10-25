<template>
    <section class="container mx-auto mt-2 md:mt-8 space-y-1">
        <inertia-link
            v-for="post in posts"
            :key="post.id"
            :href="'/ads/' + post.id"
            class=""
        >
            <div
                class="flex flex-col sm:flex-row justify-start bg-white p-3 border-b-2 border-solid border-gray-400"
            >
                <div class="border border-gray-300 bg-gray-50 sm:w-64">
                    <img
                        :src="'/media/posts/' + post.image"
                        class="w-auto mx-auto h-64 sm:h-36 bg-red-50"
                    />
                </div>
                <div class="ms-4 text-gray-500 w-full col-span-2 pe-5 mt-5">
                    <div class="flex text-xs md:text-sm font-light">
                        <div
                            class="flex justify-items-start md:space-s-2 text-sm text-gray-500 font-normal flex-grow"
                        >
                            <inertia-link
                                href="#!"
                                class="hover:underline hidden md:block"
                            >
                                {{
                                    lang == "ar"
                                        ? post.category_name_ar
                                        : post.category_name
                                }}</inertia-link
                            >
                            <div class="relative self-center hidden md:block">
                                <span
                                    class="font-bold absolute -bottom-2 start-0"
                                    >.&nbsp;</span
                                >
                            </div>
                            <a href="#!" class="hover:underline md:ps-1">{{
                                lang == "ar"
                                    ? post.region_name_ar
                                    : post.region_name
                            }}</a>
                        </div>
                        <span class="float-end">{{
                            post.created_at
                                | moment("from")
                                | moment("timezone", "Asia/Dhaka")
                        }}</span>
                    </div>
                    <inertia-link
                        :href="'/ads/' + post.id"
                        class="md:text-lg text-gray-700 font-medium hover:underline mt-3"
                    >
                        {{ post.title }}
                    </inertia-link>
                    <div
                        class="Products-items-info text-xs md:text-base text-gray-600 break-all"
                    >
                        <div
                            v-for="(attribute, index) in JSON.parse(
                                post.post_attribute
                            )"
                            :key="index"
                            class="inline-block capitalize"
                        >
                            {{ attribute.value + " " + attribute.unit }}
                        </div>
                    </div>
                    <div class="flex justify-between items-end mt-3">
                        <div class="text-green-500 md:text-base font-medium">
                            {{ post.expected_price }} {{ iqd }}
                        </div>
                    </div>
                </div>
            </div>
        </inertia-link>
    </section>
</template>

<script>
export default {
    props: {
        posts: Array
    },
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
