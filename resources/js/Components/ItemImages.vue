<template>
    <div class="relative">
        <div
            class="customPrevBtn absolute top-28 md:top-48 start-0 z-20 text-2xl opicity-10 bg-gray-800 rounded-full w-8 h-8 text-center cursor-pointer"
        >
            <i
                :class="lang == 'ar' ? 'fa-chevron-right' : 'fa-chevron-left'"
                class="fas text-white"
            ></i>
        </div>
        <!-- {{-- Owl Carousel Start --}} -->
        <div class="owl-carousel">
            <div
                v-for="post_image in post_images"
                :key="post_image.id"
                class="border border-gray-200"
            >
                <img
                    :src="'/media/posts/' + post_image.image"
                    alt=""
                    class="w-auto mx-auto h-64 md:h-96"
                />
            </div>
            <!-- <div>
        <img src="/media/product/car2.jpg" alt="" class="w-full h-96" />
      </div> -->
        </div>
        <!-- {{-- Owl Carousel End --}} -->
        <div
            class="customNextBtn absolute top-28 md:top-48 end-0 z-20 text-2xl opicity-10 bg-gray-800 rounded-full w-8 h-8 text-center cursor-pointer"
        >
            <i
                :class="lang == 'ar' ? 'fa-chevron-left' : 'fa-chevron-right'"
                class="fas text-white
        "
            ></i>
        </div>
    </div>
</template>

<script>
export default {
    props: ["post_images"],
    computed: {
        lang() {
            return this.$page.props.language;
        }
    },
    mounted() {
        // var rtl = this.lang == "ar" ? true : false;
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 1,
            loop: true,
            rtl: this.lang == "ar" ? true : false
        });
        $(".customNextBtn").click(function() {
            owl.trigger("next.owl.carousel");
        });
        $(".customPrevBtn").click(function() {
            owl.trigger("prev.owl.carousel", [300]);
        });
    }
};
</script>
<style scoped></style>
