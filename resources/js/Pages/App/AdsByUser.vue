<template>
    <app-layout>
        <search :regions="regions" :search="search" />
        <breadcrumb :breads="breads" />
        <div class="container mx-auto">
            <div class="h-48 overflow-hidden flex">
                <img
                    :src="
                        '/media/shop/banner/' +
                            (shop.shop_banner ? shop.shop_banner : '')
                    "
                    class="mx-auto self-center w-full"
                />
            </div>
            <div class="my-5" v-html="shop.shop_desc"></div>
        </div>
        <filters :reason="reason" :sorted="sorted" />
        <section
            class="container mx-auto px-3 md:grid md:grid-cols-7 gap-3 mb-5"
        >
            <div class="col-span-5">
                <filter-mobile v-if="isMobile()" />
                <filters2
                    :isIndividual="isIndividual"
                    :total="posts.total"
                    :sorted="sorted"
                    :seller="seller"
                ></filters2>
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
import Filters from "@/Components/Filters";
import FilterMobile from "@/Components/FilterMobile";
import Filters2 from "@/Components/Filters2";
import Products from "@/Components/Products";
import Pagination from "@/Components/Pagination";
import Sidebar from "@/Components/Sidebar";
import FindJob from "@/Components/FindJob.vue";
import FooterTop from "@/Components/FooterTop.vue";

export default {
    props: [
        "posts",
        "isIndividual",
        "regions",
        "reason",
        "sorted",
        "search",
        "widgets",
        "seller",
        "shop"
    ],
    data: function() {
        return {
            breads: {
                0: {
                    url: "",
                    label: this.seller
                }
            }
        };
    },
    components: {
        AppLayout,
        Search,
        Breadcrumb,
        Filters,
        FilterMobile,
        Filters2,
        Products,
        Pagination,
        Sidebar,
        FindJob,
        FooterTop
    },
    methods: {
        isMobile() {
            return screen.width <= 760 ? true : false;
        }
    }
};
</script>
