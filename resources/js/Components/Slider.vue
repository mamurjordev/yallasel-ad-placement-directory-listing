<template>
    <section class="container mx-auto">
        <div class="owl-carousel">
            <div
                v-for="vipPost in vipPosts"
                :key="vipPost.id"
                class="bg-white flex justify-items-start p-3 border-b-2 border-solid border-gray-400"
            >
                <img
                    :src="'/media/posts/' + vipPost.image"
                    alt=""
                    class="w-32 h-full"
                />
                <div class="ms-4 text-gray-500 text-sm w-full">
                    <div class="flex text-xs md:text-sm font-light">
                        <div
                            class="flex justify-items-start md:space-s-2 text-sm text-gray-500 font-normal flex-grow"
                        >
                            <inertia-link
                                :href="'/category/' + vipPost.category_id"
                                class="hover:underline hidden md:block"
                            >
                                {{ vipPost.category_name }}</inertia-link
                            >
                            <div class="relative self-center hidden md:block">
                                <span
                                    class="font-bold absolute -bottom-2 start-0"
                                    >.&nbsp;</span
                                >
                            </div>
                            <a href="#!" class="hover:underline md:ps-1">{{
                                lang == "ar"
                                    ? vipPost.region_name_ar
                                    : vipPost.region_name
                            }}</a>
                        </div>
                        <span class="float-end hidden md:block">Listed</span>
                    </div>
                    <inertia-link
                        :href="'/ads/' + vipPost.id"
                        class="md:text-lg text-gray-700 font-medium hover:underline"
                        >{{ vipPost.title }}</inertia-link
                    >
                    <p class="hidden md:block">Diesel - 2021</p>
                    <div class="flex justify-between items-end">
                        <div class="text-green-500 text-base font-medium">
                            {{ vipPost.expected_price }} IQD
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="vipPosts.length > 1"
            class="flex md:justify-between owl-theme mt-3"
        >
            <div class="text-gray-500 owlPrev hidden md:block">
                <i
                    class="fas fa-angle-double-left text-sm"
                    style="transform: scaleX(1)"
                ></i>
                {{ __("Previous") }}
            </div>
            <div
                class="owlDots owl-dots mx-auto"
                id="carousel-custom-dots"
            ></div>
            <div class="text-gray-500 owlNext hidden md:block">
                {{ __("Next") }}
                <i
                    class="fas fa-angle-double-right text-sm"
                    style="transform: scaleX(1)"
                ></i>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ["vipPosts"]
};
</script>

<style scoped>
.owlPrev:hover,
.owlNext:hover {
    cursor: pointer;
}
</style>
