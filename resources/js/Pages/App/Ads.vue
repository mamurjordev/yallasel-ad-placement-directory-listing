<template>
    <app-layout>
        <search
            :regions="regions"
            :search="search"
            :regionsSelect="regionsSelect"
        />
        <breadcrumb :breads="breads" />
        <!-- {{ childs }} -->
        <categories-link :categories="categories" />
        <filters :reason="reason" :sorted="sorted" />
        <CarFilters
            v-if="category.id == 1"
            class="container mx-auto px-3 mt-5"
            :filters="filters"
        />
        <section
            class="container mx-auto px-3 md:grid md:grid-cols-7 gap-3 mb-5"
        >
            <div class="col-span-5">
                <filter-mobile
                    v-if="isMobile()"
                    :total="posts.total"
                    :reason="reason"
                    :isIndividual="isIndividual"
                    :sorted="sorted"
                    :filters="filters"
                />
                <filters2
                    :isIndividual="isIndividual"
                    :total="posts.total"
                    :sorted="sorted"
                ></filters2>
                <slider :vipPosts="vipPosts"></slider>
                <products
                    v-if="posts.data.length"
                    :posts="posts.data"
                ></products>
                <div
                    v-else
                    class="text-center text-2xl text-gray-500 my-10 border border-gray-500 py-5"
                >
                    {{ __("No Product found in this category") }}
                </div>
                <pagination
                    v-if="posts.data.length"
                    :links="posts.links"
                    :from="posts.from"
                    :to="posts.to"
                    :total="posts.total"
                ></pagination>
            </div>
            <sidebar
                class="col-span-2 ms-2 hidden md:block rounded"
                :widgets="widgets"
            ></sidebar>
        </section>
        <find-job v-if="1 == 0"></find-job>
        <!-- <footer-top></footer-top> -->
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Search from "@/Components/Search";
import Breadcrumb from "@/Components/Breadcrumb";
import CategoriesLink from "@/Components/CategoriesLink";
import Filters from "@/Components/Filters";
import CarFilters from "@/Components/Filters/Car.vue";
import FilterMobile from "@/Components/FilterMobile";
import Filters2 from "@/Components/Filters2";
import Slider from "@/Components/Slider.vue";
import Products from "@/Components/Products";
import Pagination from "@/Components/Pagination";
import Sidebar from "@/Components/Sidebar";
import FindJob from "@/Components/FindJob.vue";
import FooterTop from "@/Components/FooterTop.vue";

export default {
    props: [
        "categories",
        "posts",
        "vipPosts",
        "category",
        "isIndividual",
        "regions",
        "reason",
        "sorted",
        "search",
        "widgets",
        "regionsSelect",
        "filters"
    ],
    data: function() {
        return {
            breads: null
        };
    },
    components: {
        AppLayout,
        Search,
        Breadcrumb,
        CategoriesLink,
        Filters,
        CarFilters,
        FilterMobile,
        Filters2,
        Slider,
        Products,
        Pagination,
        Sidebar,
        FindJob,
        FooterTop
    },
    mounted() {
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true
        });
        $(".owlNext").click(function() {
            owl.trigger("next.owl.carousel");
        });
        $(".owlPrev").click(function() {
            owl.trigger("prev.owl.carousel", [300]);
        });
        if (this.category) {
            this.breads = {
                0: {
                    url: "/category/" + this.category.id,
                    label: this.category.category_name ?? ""
                }
            };
        }
    },
    methods: {
        isMobile() {
            return screen.width <= 760 ? true : false;
        }
    }
};
</script>
